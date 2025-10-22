<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'release_date',
        'developer_id',
        'genre_id',
        'platform'
    ];

    protected $casts = [
        'release_date' => 'date:Y-m-d',
        'deleted_at' => 'datetime',
    ];

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class)->withDefault([
            'name' => 'Unknown'
        ]);
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class)->withDefault([
            'name' => 'Unknown'
        ]);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'game_genre');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeFilter($query, array $filters): void
    {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
        $query->where('title', 'like', '%'.$search.'%')
        );

        $query->when($filters['platform'] ?? false, fn($query, $platform) =>
        $query->where('platform', $platform)
        );

        $query->when($filters['genre'] ?? false, fn($query, $genreId) =>
        $query->whereHas('genres', fn($query) =>
        $query->where('genres.id', $genreId)
        )
        );
    }
}
