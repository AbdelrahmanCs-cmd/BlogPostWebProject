<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'status',
        'published_at',
        'image',
        'slug'
    ];
    //CREATING SLUG after save data in databasee 
    protected static function booted(): void
    {
        static::creating(function (Blog $blog) {
            $blog->slug = Str::slug($blog->title);
        });

        static::created(function (Blog $blog) {
            $blog->slug = Str::slug($blog->title . '-' . $blog->id);
            $blog->saveQuietly();
        });
    }
    //RELATIONS
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
