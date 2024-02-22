<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'media',
        'user_id'
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function addComment($body)
    {
        $this->comments()->create(compact('body'));
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query
                ->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('body', 'like', '%' . request('search') . '%');
        }
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    // public static function archives()
    // {
    //     return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
    //         ->groupBy('year', 'month')
    //         ->orderByRaw('min(created_at) desc')
    //         ->get()
    //         ->toArray();
    // }

    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class);
    // }
}
