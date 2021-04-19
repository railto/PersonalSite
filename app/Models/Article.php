<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'slug', 'content', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            $slug = Str::slug($article->title);

            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

            $article->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function path(): string
    {
        return route('articles.view', ['article' => $this]);
    }
}
