<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'legal_title',
        'known_as',
        'parent_id',
        'status',
        'type',
        'profile_type',
        'ownership_type',
        'business_model',
        'ipo',
        'num_employees',
        'description',
        'body',
        'phone',
        'email',
        'province_id',
        'city_id',
        'primary_address',
        'secondary_address',
        'founded_year',
        'founded_month',
        'founded_day',
        'registered_year',
        'registered_month',
        'registered_day',
        'closed_year',
        'closed_month',
        'closed_day',
        'imageUrl',
    ];

    /**
     * Get the categories that belongs to the organization.
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the province that owns the organization.
     *
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Get the city that owns the organization.
     *
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the websites for the organization.
     */
    public function websites(): HasMany
    {
        return $this->hasMany(Website::class);
    }

    /**
     * Get the applications of the organization.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Get the social network's of the organization
     */
    public function socialNetworks(): HasMany
    {
        return $this->hasMany(SocialNetwork::class);
    }

    public function hubs(): BelongsToMany
    {
        return $this->belongsToMany(Hub::class);
    }

    /**
     * Get available statuses for the organization.
     */
    public static function getStatuses(): array
    {
        return [
            'active' => 'فعال',
            'deactivated' => 'غیرفعال',
            'closed' => 'اتمام فعالیت',
        ];
    }

    /**
     * Get status title for the organization.
     */
    public function getStatusTitle(): string
    {
        switch ($this->status) {
            case 'active':
                $title = 'فعال';
                break;
            case 'deactivated':
                $title = 'غیرفعال';
                break;
            case 'closed':
                $title = 'اتمام فعالیت';
                break;
            default:
                $title = '';
        }

        return $title;
    }

    /**
     * Get available types for the organization.
     */
    public static function getTypes(): array
    {
        return [
            'startup-studio' => 'استارتاپ استودیو',
            'foreign-investor' => 'سرمایه‌گذار خارجی',
            'corporate-venture-capitalist' => 'سرمایه‌گذار خطرپذیر شرکتی',
            'major-investor' => 'سرمایه‌گذار کلان',
            'government-investor' => 'سرمایه‌گذار دولتی و سازمانی',
            'angel-investor' => 'سرمایه‌گذار فرشته',
            'accelerator' => 'شتابدهنده',
            'venture-capital-company' => 'شرکت سرمایه‌گذاری خطرپذیر',
            'research-fund' => 'صندوق پژوهش و فناوری',
            'venture-capital-fund' => 'صندوق سرمایه‌گذاری خطرپذیر',
            'business' => 'کسب‌و‌کار',
            'innovation-center' => 'مرکز نوآوری',
            'investment-holding' => 'هلدینگ سرمایه‌گذاری',
            'other' => 'سایر(شامل سرمایه‌گذاری جمعی و ...)',
        ];
    }

    /**
     * Get available profile_types for the organization
     */
    public static function getProfileTypes(): array
    {
        return [
            'organization' => 'شرکت',
            'investment-firm' => 'شرکت سرمایه‌گذاری',
        ];
    }

    /**
     * Get profile_type title for the organization.
     */
    public function getProfileTypeTitle(): string
    {
        switch ($this->profile_type) {
            case 'organization':
                $title = 'کسب‌و‌کار';
                break;
            case 'investment-firm':
                $title = 'شرکت سرمایه‌گذاری';
                break;
            default:
                $title = '';
        }

        return $title;
    }

    /**
     * Get available ownership_types for the organization.
     */
    public static function getOwnershipTypes(): array
    {
        return [
            'private' => 'سهامی خاص',
            'limited' => 'مسئولیت محدود',
            'solidarity' => 'تضامنی',
            'cooperative' => 'تعاونی',
            'public' => 'سهامی عام',
        ];
    }

    /**
     * Get ownership_type title for the organization.
     */
    public function getOwnershipTypeTitle(): string
    {
        switch ($this->ownership_type) {
            case 'private':
                $title = 'سهامی خاص';
                break;
            case 'limited':
                $title = 'مسئولیت محدود';
                break;
            case 'solidarity':
                $title = 'تضامنی';
                break;
            case 'cooperative':
                $title = 'تعاونی';
                break;
            case 'public':
                $title = 'سهامی عام';
                break;
            default:
                $title = '';
        }

        return $title;
    }

    /**
     * Get available business_models for the organization.
     */
    public static function getBusinessModels(): array
    {
        return [
            'B2B',
            'B2C',
            'C2C',
            'B2B-B2C',
            'B2C-C2C',
            'C2B',
            'B2G',
        ];
    }

    /**
     * Get available IPO statuses for the organization.
     */
    public static function getIpoStatuses(): array
    {
        return [
            'public' => 'عمومی',
            'private' => 'خصوصی',
            'delisted' => 'حذف‌ شده',
        ];
    }
}
