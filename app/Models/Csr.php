<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Csr extends Model
{
    use SoftDeletes;

    protected $table = 'csrs';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'featured_image',
        'thumbnail_image',
        'gallery_images',
        'beneficiaries_count',
        'budget',
        'location',
        'year',
        'duration',
        'achievements',
        'impact_metrics',
        'testimonials',
        'partners',
        'team_members',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'published_at',
        'views',
        'likes',
        'shares',
        'sort_order',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'impact_metrics' => 'array',
        'team_members' => 'array',
        'budget' => 'decimal:2',
        'beneficiaries_count' => 'integer',
        'year' => 'integer',
        'views' => 'integer',
        'likes' => 'integer',
        'shares' => 'integer',
        'sort_order' => 'integer',
        'published_at' => 'datetime',
    ];

    /**
     * Get available categories with details
     */
    public static function getCategories()
    {
        return [
            'social' => [
                'name' => 'Sosial',
                'description' => 'Program untuk meningkatkan kesejahteraan masyarakat',
                'icon' => '👥',
                'bg_color' => 'bg-blue-100',
                'text_color' => 'text-blue-700',
            ],
            'environment' => [
                'name' => 'Lingkungan',
                'description' => 'Program untuk menjaga kelestarian lingkungan',
                'icon' => '🌱',
                'bg_color' => 'bg-green-100',
                'text_color' => 'text-green-700',
            ],
            'quality' => [
                'name' => 'Kualitas Hidup',
                'description' => 'Program untuk meningkatkan kualitas hidup masyarakat',
                'icon' => '⭐',
                'bg_color' => 'bg-emerald-100',
                'text_color' => 'text-emerald-700',
            ],
        ];
    }

    /**
     * Get category details
     */
    public function getCategoryDetailsAttribute()
    {
        $categories = self::getCategories();

        return $categories[$this->category] ?? [
            'name' => ucfirst($this->category),
            'full_name' => ucfirst($this->category),
            'description' => '',
            'color' => '#6b7280',
            'icon' => 'document-text',
        ];
    }

    /**
     * Get category name
     */
    public function getCategoryNameAttribute()
    {
        return $this->categoryDetails['name'];
    }

    /**
     * Get category color
     */
    public function getCategoryColorAttribute()
    {
        return $this->categoryDetails['color'] ?? '#6B7280';
    }

    /**
     * Scope a query to only include published programs.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope a query to only include draft programs.
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope a query to only include archived programs.
     */
    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    /**
     * Scope by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope by year
     */
    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    /**
     * Get formatted budget
     */
    public function getFormattedBudgetAttribute()
    {
        if (! $this->budget) {
            return 'Tidak tersedia';
        }

        if ($this->budget >= 1000000000) {
            return 'Rp '.number_format($this->budget / 1000000000, 2).' Miliar';
        } elseif ($this->budget >= 1000000) {
            return 'Rp '.number_format($this->budget / 1000000, 2).' Juta';
        } else {
            return 'Rp '.number_format($this->budget, 0, ',', '.');
        }
    }

    /**
     * Get formatted beneficiaries
     */
    public function getFormattedBeneficiariesAttribute()
    {
        if (! $this->beneficiaries_count) {
            return 'Tidak tersedia';
        }

        if ($this->beneficiaries_count >= 1000) {
            return number_format($this->beneficiaries_count / 1000, 1).' Ribu';
        }

        return number_format($this->beneficiaries_count, 0, ',', '.');
    }

    /**
     * Get featured image URL
     */
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            return asset('storage/'.$this->featured_image);
        }

        // Default images based on category
        $defaultImages = [
            'social' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'environment' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'quality' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        ];

        return $defaultImages[$this->category]
            ?? 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
    }

    /**
     * Get thumbnail image URL
     */
    public function getThumbnailImageUrlAttribute()
    {
        if ($this->thumbnail_image) {
            return asset('storage/'.$this->thumbnail_image);
        }

        return $this->featured_image_url;
    }

    /**
     * Get gallery images URLs
     */
   public function getGalleryImagesUrlsAttribute()
{
    if (! $this->gallery_images || !is_array($this->gallery_images)) {
        return [];
    }

    return array_map(function ($image) {
        return asset('storage/' . $image);
    }, $this->gallery_images);
}


    /**
     * Get user who created the CSR
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get user who last updated the CSR
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
