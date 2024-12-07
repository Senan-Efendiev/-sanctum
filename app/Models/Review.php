<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'game_id',
        'user_id',
        'rating',
        'comment',
    ];

    public function games()
    {
        return $this->belongsTo(Game::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
