<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'title',
        'release_date',
        'genre_id', // Это поле нужно, если у вас есть отношение "один-ко-многим" с жанром
        'developer_id',
        'platform',
    ];

    // Определение отношения "принадлежит" к разработчику
    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    // Определение отношения с основным жанром (если он есть)
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    // Определение отношения многие-ко-многим с жанрами
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'game_genre');
    }

    // Определение отношения с отзывами
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
