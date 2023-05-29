<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'url',
        'source',
        'registered_at',
    ];

    /**
     * Get the news's registered_at
     *
     * @param  datetime  $value
     * @return integer
     */
    public function getRegisteredAtAttribute($value)
    {
        return strtotime($value);
    }

    /**
     * Set the news's registered_at
     *
     * @param  integer  $value
     * @return void
     */
    public function setRegisteredAtAttribute($value)
    {
        $this->attributes['registered_at'] = date('Y-m-d H:i:s', (int) $value / 1000);
    }

    /**
     * Search filter query
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('url', 'LIKE', '%' . $search . '%')
                ->orWhere('reference', 'LIKE', '%' . $search . '%');
        });
    }

    /**
     * Get all tags for the specified resource
     */
    public function tags(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
