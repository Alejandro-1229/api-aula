<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    public function user():HasMany
    {
        return $this->hasMany(User::class);
    }

    public function interest():BelongsToMany
    {
        return $this->belongsToMany(Interest::class);
    }

    protected $fillable = [
        'user_id',
    ];
}
