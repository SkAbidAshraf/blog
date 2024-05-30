<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')
                        ->required()
                        ->columnSpan(1)
                        ->placeholder('Enter name')
                        ->maxLength(255)->disabledOn('edit'),
                    TextInput::make('email')
                        ->email()
                        ->autocomplete(false)
                        ->required()
                        ->placeholder('Enter email')
                        ->columnSpan(1)
                        ->maxLength(255)->disabled()->disabledOn('edit'),
                    Select::make('role')
                        ->required()
                        ->columnSpan(2)
                        ->options(User::ROLES),
                    TextInput::make('password')
                        ->password()
                        ->placeholder('Enter password')
                        ->autocomplete(false)
                        ->required()
                        ->maxLength(255)->hiddenOn('edit')->revealable(),
                    TextInput::make('password_confirmation')
                        ->password()
                        ->placeholder('Confirm password')
                        ->autocomplete(false)
                        ->required()
                        ->maxLength(255)->hiddenOn('edit')->revealable(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')
                    ->searchable()->wrap(),
                TextColumn::make('email')
                    ->searchable()->wrap(),
                TextColumn::make('role')
                    ->searchable()->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
