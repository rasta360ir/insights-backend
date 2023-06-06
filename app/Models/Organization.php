<?php

namespace App\Models;

use App\Enums\OrganizationBusinessModelEnum;
use App\Enums\OrganizationIpoEnum;
use App\Enums\OrganizationOwnershipTypeEnum;
use App\Enums\OrganizationProfileTypeEnum;
use App\Enums\OrganizationStatusEnum;
use App\Enums\OrganizationTypeEnum;
use Illuminate\Database\Eloquent\Builder;
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

    protected $casts = [
//        'status' => OrganizationStatusEnum::class,
//        'type' => OrganizationTypeEnum::class,
//        'profile_type' => OrganizationProfileTypeEnum::class,
//        'ownership_type' => OrganizationOwnershipTypeEnum::class,
//        'business_model' => OrganizationBusinessModelEnum::class,
//        'ipo' => OrganizationIpoEnum::class,
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

    /**
     * Get the people that belongs to the organization
     */
    public function people(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    /**
     * Relation, agreements of the resource
     */
    public function agreements(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Agreement::class)
            ->withPivot(['party']);
    }

    /**
     * Relation, agreements of the resource that is in first side
     */
    public function firstSideParty(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Agreement::class,
            'agreement_organization',
            'organization_id',
            'agreement_id'
        )
            ->withPivot(['party'])
            ->wherePivot('party', 1);
    }

    /**
     * Relation, agreements of the resource that is in second side
     */
    public function secondSideParty(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Agreement::class,
            'agreement_organization',
            'organization_id',
            'agreement_id'
        )
            ->withPivot(['party'])
            ->wherePivot('party', 2);
    }

    public function isInvestmentPartner()
    {
        return $this->belongsToMany(
            Agreement::class,
            'agreement_partners',
            'organization_id',
            'agreement_id'
        );
    }

    public function hubs(): BelongsToMany
    {
        return $this->belongsToMany(Hub::class);
    }

    /**
     * Get related News for the specified resource
     */
    public function relatedNews($count = 4)
    {
        $categories = $this->categories;
        $tags = $categories->map(function ($catgory) {
            return Tag::where('slug', $catgory->slug)->first()->id;
        })->toArray();

        $tags = array_merge($tags, [Tag::where('slug', $this->slug)->first()->id] ?? []);

        $news = News::whereHas('tags', function (Builder $query) use ($tags) {
            $query->whereIn('id', $tags);
        })->orderBy('registered_at', 'DESC')->take($count);
        return $news;
    }
}
