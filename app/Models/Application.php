<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organization_id',
        'platform',
        'url',
    ];

    /**
     * Get the organization that owns the application.
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function applicationLogs(): HasMany
    {
        return $this->hasMany(ApplicationLog::class);
    }

    /**
     * Get available platforms for the application.
     */
    public static function getPlatforms(): array
    {
        return [
            'googleplay' => 'گوگل‌پلی',
            'cafebazar' => 'کافه‌بازار',
            'myket' => 'مایکت',
        ];
    }
}
