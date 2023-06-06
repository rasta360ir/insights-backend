<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialNetwork extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organization_id',
        'platform',
        'url',
    ];

    /**
     * Relation, a social network belongs to an organization
     *
     * @return BelongsTo
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     *  Return available social network types
     */
    public static function getPlatforms(): array
    {
        return [
            'instagram' => 'اینستاگرام',
            'linkedin' => 'لینکدین',
            'twitter' => 'توئیتر',
            'telegram' => 'تلگرام',
        ];
    }
}
