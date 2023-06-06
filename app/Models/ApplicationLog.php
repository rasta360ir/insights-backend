<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'downloads',
        'rate',
        'votes',
        'version',
        'registered_at'
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}
