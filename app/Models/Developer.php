<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Developer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'founded'];
    protected $casts = [
        'founded' => 'date:Y-m-d',
        'deleted_at' => 'datetime',
    ];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
