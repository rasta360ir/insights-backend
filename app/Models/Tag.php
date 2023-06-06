<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    /**
     * Get all news that assigned to the specified Tag
     */
    public function news(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(News::class, 'taggable');
    }
}
