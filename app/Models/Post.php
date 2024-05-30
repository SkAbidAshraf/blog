<?php

namespace App\Models;

use Carbon\Carbon;
// use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'content',
        'published_at',
        'featured',
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_like')->withTimestamps();
    }

    public function scopeLiked($query, $userId)
    {
        return $query->whereHas('likes', function($q) use ($userId) {
            $q->where('user_id', $userId);
        });
    }

    public function bookmarks()
    {
        return $this->belongsToMany(User::class, 'post_bookmark')->withTimestamps();
    }
    public function scopeBookmarked($query, $userId)
    {
        return $query->whereHas('bookmarks', function($q) use ($userId) {
            $q->where('user_id', $userId);
        });
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopePublished($query)
    {
        $query -> where('published_at', '<=', Carbon::now());
    }

    public function scopeFeatured($query)
    {
        $query -> where('featured', true);
    }

    public function scopeTag($query, string $tag)
    {
        $query -> whereHas('tags', function($query) use ($tag) {
            $query->where('slug', $tag);
        });
    }

    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->content), 200);

    }

    public function getReadingTime()
    {
        $minutes = round(str_word_count($this->content) / 225);

        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        if ($hours > 0) {
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ' . $remainingMinutes . ' minute' . ($remainingMinutes > 1 ? 's' : '');
        } else {
            return $remainingMinutes . ' minute' . ($remainingMinutes > 1 ? 's' : '');
        }
    }

    public function getThumbnailImage()
    {
        $isUrl = str_contains($this->image, 'http');

        return ($isUrl) ? $this->image : Storage::disk('public')->url($this->image);
    }

    public function getPublishedDate()
    {
        return $this->published_at->format('Y-m-d, h:i A');
    }
}
