<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialty extends Model
{
    use HasFactory;

    public function teacher():HasMany
    {
        return $this->hasMany(Teacher::class);
    }

    protected $fillable = [
        'specialty_description',
    ];
}
