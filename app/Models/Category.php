<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'body',
    ];

    /**
     * Scope a query to only include head categories.
     */
    public function scopeHead($query)
    {
        return $query->where('parent_id', null);
    }

    /**
     * Get parent of the category.
     */
    public function parent(): BelongsTo
    {
        return $this
            ->belongsTo(Category::class, 'parent_id')
            ->where('parent_id', null);
    }

    /**
     * Get subcategories of the category.
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get the organizations that belongs to the category.
     */
    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class);
    }
}
