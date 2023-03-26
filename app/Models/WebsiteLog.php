<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'visits',
        'year',
        'month',
    ];

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}
