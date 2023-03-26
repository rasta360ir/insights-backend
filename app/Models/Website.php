<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organization_id', 'url',
    ];

    /**
     * Get the organization that owns the website.
     *
     * @return BelongsTo
     */
    function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
