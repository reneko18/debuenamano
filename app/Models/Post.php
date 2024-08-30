<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
