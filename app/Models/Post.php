<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'main_img',
        'caption_img',
        'author_id',
        'slug',
        'meta_title',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function postcategories()
    {
        return $this->belongsToMany(PostCategory::class, 'post_category', 'post_id', 'post_category_id');
    }

    /*Scope Filters*/ 
    public function scopeWithPostFilters($query, $authors, $postcategories,$order = 'desc')
    {
        $authors = is_array($authors) ? $authors : [$authors];
        $postcategories = is_array($postcategories) ? $postcategories : [$postcategories];
    
        return $query->when(count($authors), function ($query) use ($authors) {
            $query->whereIn('author_id', $authors);
        })
        ->when(count($postcategories), function ($query) use ($postcategories) {
            $query->whereHas('postcategories', function ($query) use ($postcategories) {
                $query->whereIn('post_category_id', $postcategories);
            });
        })
        ->orderBy('created_at', $order); // Apply ordering
    }

    /*Scope Filters Authors*/ 
    public function scopeWithAuthorFilters($query,$postcategories,$order = 'desc')
    {
            $postcategories = is_array($postcategories) ? $postcategories : [$postcategories];
    
        return $query->when(count($postcategories), function ($query) use ($postcategories) {
            $query->whereHas('postcategories', function ($query) use ($postcategories) {
                $query->whereIn('post_category_id', $postcategories);
            });
        })
        ->orderBy('created_at', $order); // Apply ordering
    }

    /* Scope Filters Categories */
    public function scopeWithCategoryFilters($query, $authors, $order = 'desc')
    {
        $authors = is_array($authors) ? $authors : [$authors];

        return $query->when(count($authors), function ($query) use ($authors) {
            $query->whereHas('author', function ($query) use ($authors) {
                $query->whereIn('id', $authors); 
            });
        })
        ->orderBy('created_at', $order); // Apply ordering
    }

    public function getFormattedCreatedAt()
    {
        $createdAt = Carbon::parse($this->created_at);
        $now = Carbon::now();

        if ($createdAt->isToday()) {
            return 'Hoy';
        } elseif ($createdAt->diffInDays($now) === 1) {
            return 'hace 1 dia';
        } elseif ($createdAt->diffInDays($now) <= 7) {
            return  'hace ' . $createdAt->diffInDays($now) . ' dias';
        } elseif ($createdAt->diffInWeeks($now) === 1) {
            return 'hace 1 semana';
        } elseif ($createdAt->diffInWeeks($now) <= 4) {
            return 'hace ' . $createdAt->diffInWeeks($now) . ' dias';
        } else {
            return 'el ' . $createdAt->format('d/m/Y');
        }
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
