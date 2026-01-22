<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'thumbnail_image',
        'status',
        'published_at',
        'author',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'views',
        'likes',
        'shares',
        'category_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views' => 'integer',
        'likes' => 'integer',
        'shares' => 'integer',
    ];

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }

            if (empty($news->created_by) && Auth::check()) {
                $news->created_by = Auth::id();
            }
        });

        static::updating(function ($news) {
            if ($news->isDirty('title')) {
                $news->slug = Str::slug($news->title);
            }

            if (Auth::check()) {
                $news->updated_by = Auth::id();
            }
        });
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    public function scopeRecent($query, $limit = 5)
    {
        return $query->published()->latest('published_at')->limit($limit);
    }

    public function scopePopular($query, $limit = 5)
    {
        return $query->published()->orderBy('views', 'desc')->limit($limit);
    }

    // Helpers
    public function isPublished()
    {
        return $this->status === 'published' &&
            $this->published_at &&
            $this->published_at <= now();
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getReadingTime()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $readingTime = ceil($wordCount / 200);

        return max(1, $readingTime);
    }

    public function getFeaturedImageUrl()
    {
        if ($this->featured_image) {
            return asset('storage/'.$this->featured_image);
        }

        return asset('images/default-news.jpg');
    }

    public function getThumbnailUrl()
    {
        if ($this->thumbnail_image) {
            return asset('storage/'.$this->thumbnail_image);
        }

        return $this->getFeaturedImageUrl();
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail_image) {
            return asset('storage/'.$this->thumbnail_image);
        }

        return asset('images/no-image.png'); // atau placeholder default kamu
    }

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            return asset('storage/'.$this->featured_image);
        }

        return asset('images/default-news.jpg');
    }
}
