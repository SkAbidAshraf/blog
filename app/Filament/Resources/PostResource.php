<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Filament\Resources\PostResource\RelationManagers\CommentsRelationManager;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

use function Laravel\Prompts\select;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Main content')->schema([
                    TextInput::make('title')
                        ->live(onBlur: true)
                        ->placeholder('Enter post title')
                        ->required()
                        ->minLength(1)
                        ->maxLength(150)
                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                            $set('slug', Str::slug($state));
                        }),
                    TextInput::make('slug')
                        ->required()
                        ->placeholder('Enter post slug')
                        ->unique(ignoreRecord: true)
                        ->minLength(1)
                        ->maxLength(150),
                    RichEditor::make('content')->required()->fileAttachmentsDirectory('posts/images')->columnSpanFull()
                        ->placeholder('Enter post content'),

                ])->columns(2),
                Section::make('Meta')->schema([
                    FileUpload::make('image')->image()->directory('posts/thumbnails')->imageEditor()
                        ->imageEditorViewportWidth('1920')
                        ->imageEditorViewportHeight('1080')->deletable()->openable()->previewable(),
                    Select::make('user_id')->relationship('author', 'name')->label('Author')->required()->default(auth()->id())->disabled(),
                    Hidden::make('user_id')->disabledOn('edit')->required()->default(auth()->id()),
                    Select::make('tags')->relationship('tags', 'title')->searchable()->multiple()->preload(),
                    DateTimePicker::make('published_at')->nullable()->minDate(function (string $operation) {
                        if ($operation !== 'edit') {
                            return now();
                        }
                    }),
                    Checkbox::make('featured'),
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                ImageColumn::make('image')->square(),
                TextColumn::make('title')->sortable()->searchable()->wrap(),
                TextColumn::make('slug')->sortable()->searchable()->limit(10)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('author.name')->sortable()->searchable()->wrap(),
                TextColumn::make('published_at')->date('d-m-y')->sortable()->searchable(),
                TextColumn::make('created_at')->date('d-m-y')->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                CheckboxColumn::make('featured')->sortable()->visible(auth()->user()->isAdmin()),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-m-pencil-square')
                    ->iconButton(),
                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-m-trash')
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CommentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
