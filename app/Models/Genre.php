<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Определяет отношение "один-ко-многим" с моделью Game.
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_genre');
    }


}
