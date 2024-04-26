<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use HasFactory;

    public function user(): HasMany{
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        "name",
        "last_name",
        "email",
        "cell_phone",
        "status"
    ];
}
