<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }
}
