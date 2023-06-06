<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'investment_type',
        'status',
        'stock',
        'amount',
        'currency_id',
        'description',
        'references',
        'year',
        'month',
        'comment',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query
                ->whereHas('firstSideMembers', function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('secondSideMembers', function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%');
                })
                ->orWhere('type', 'LIKE', '%' . $search . '%');
        });
    }

    /**
     * Scope, filter investments
     */
    public function scopeInvestment($query)
    {
        $query->where('type', 'investment');
    }

    /**
     * Scope, filter exits
     */
    public function scopeExit($query)
    {
        $query->where('type', 'exit');
    }

    /**
     * Scope, filter changes
     */
    public function scopeChange($query)
    {
        $query->where('type', 'change');
    }

    /**
     * Scope, filter acquisitions
     */
    public function scopeAcquisition($query)
    {
        $query->where('type', 'acquisition');
    }

    /**
     * Scope, filter merges
     */
    public function scopeMerge($query)
    {
        $query->where('type', 'merge');
    }

    /**
     * Relation, organizations of the resource
     */
    public function organizations(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Organization::class)
            ->withPivot(['party']);
    }

    /**
     * Relation, organizations of the resource that are in first side
     */
    public function firstSideMembers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Organization::class,
            'agreement_organization',
            'agreement_id',
            'organization_id'
        )
            ->withPivot(['party'])
            ->wherePivot('party', 1);
    }

    /**
     * Relation, organizations of the resource that are in second side
     */
    public function secondSideMembers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Organization::class,
            'agreement_organization',
            'agreement_id',
            'organization_id'
        )
            ->withPivot(['party'])
            ->wherePivot('party', 2);
    }

    /**
     * Relation, partners in second side of agreement
     */
    public function partners()
    {
        return $this->belongsToMany(Organization::class, 'agreement_partners');
    }

    /**
     * Relation, currency of the specified resource
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Return available types for an agreement
     */
    public static function getTypes(): array
    {
        return [
            'investment' => 'سرمایه‌گذاری',
            // 'exit' => 'خروج',
            // 'change' => 'تغییر سهام',
            'acquisition' => 'خرید',
            'merge' => 'ادغام',
        ];
    }

    /**
     * Return available statuses for an agreement
     */
    public static function getStatuses(): array
    {
        return [
            'active' => 'فعال',
            'deactivated' => 'غیرفعال',
            'exit' => 'خروج',
        ];
    }

    /**
     * Return available types for an agreement investment
     */
    public static function getInvestmentTypes(): array
    {
        return [
            'pre-seed' => 'پیش بذری',
            'seed' => 'بذری',
            'early-stage' => 'مرحله اولیه',
            'mid-stage' => 'مرحله میانی',
            'late-stage' => 'مرحله پایانی',
        ];
    }

    /**
     * Return persian title of agreement`s investment_type
     */
    public function getInvestmentTypeTitle($investment_type)
    {
        return Agreement::getInvestmentTypes()[$investment_type] ?? '';
    }

    /**
     * Return persian title of agreement`s type
     */
    public function getTypeTitle()
    {
        $title = '';
        switch ($this->type) {
            case 'investment':
                $title = 'سرمایه‌گذاری';
                break;
            // case 'exit':
            //     $title = 'خروج';
            //     break;
            // case 'change':
            //     $title = 'تغییر سهام';
            //     break;
            case 'acquisition':
                $title = 'خرید';
                break;
            case 'merge':
                $title = 'ادغام';
                break;
        }

        return $title;
    }

    /**
     * Return persian title of agreement`s status
     */
    public function getStatusTitle()
    {
        $title = '';
        switch ($this->status) {
            case 'active':
                $title = 'فعال';
                break;
            case 'deactivated':
                $title = 'غیرفعال';
                break;
            case 'exit':
                $title = 'خروج';
                break;
        }

        return $title;
    }
}
