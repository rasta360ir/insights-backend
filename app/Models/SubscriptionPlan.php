<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    const MONTH_DURATION = 30;
    const YEAR_DURATION = 365;

    protected $fillable = [
        'title',
        'slug',
        'monthly_price',
        'yearly_price',
        'featured',
    ];

    public function features()
    {
        return $this->hasMany(SubscriptionPlanFeature::class);
    }
}
