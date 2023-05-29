<?php

namespace App\Services\Insights;

use App\Models\News;
use App\Models\Organization;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class OrganizationService
{
    /**
     * Get organization`s competitors
     */
    public static function getCompetitors(Organization $organization)
    {
        $competitors = collect();
        $headCategories = $organization->categories()->head()->get();
        $subcategory_ids = $organization->categories()->subcategories()->get()->pluck('id')->toArray();

        foreach ($headCategories as $headCategory) {
            foreach ($headCategory->organizations()->with(['categories'])->where('status', 'active')->get() as $item) {
                if ($organization->id !== $item->id) {
                    $result = array_intersect($subcategory_ids, $item->categories()->subcategories()->get()->pluck('id')->toArray());
                    if (count($result)) {
                        $competitors->push([
                            'organization' => $item,
                            'id' => $item->id,
                            'priority' => count($result),
                        ]);
                    }
                }
            }
        }

        // make unique
        $competitors = $competitors->unique('id');

        // sort $competitors
        $sortedCompetitors = $competitors->sortByDesc('priority');
        $sortedCompetitors = $sortedCompetitors->map(function ($competitor) {
            return $competitor['organization'];
        });

        return $sortedCompetitors;
    }

    /**
     * Get organization`s statistics
     */
    public static function getStatistics(Organization $organization)
    {
        $websiteLastMonthVisits = WebsiteService::lastMonthVisits($organization);
        $websiteTotalLogs = WebsiteService::logs($organization);
        $websiteAverageLatestThreeMonths = WebsiteService::averageLatestThreeMonths($organization);

        $appCafebazarLog = ApplicationService::cafebazarApp($organization);
        $appGooglePlayLog = ApplicationService::googleplayApp($organization);

        return [
            'websiteLastMonthVisits' => $websiteLastMonthVisits,
            'websiteTotalLogs' => $websiteTotalLogs,
            'websiteAverageLatestThreeMonths' => $websiteAverageLatestThreeMonths,
            'appCafebazarLog' => $appCafebazarLog,
            'appGooglePlayLog' => $appGooglePlayLog,
        ];
    }

    /**
     * Get related News for the specified resource
     */
    public static function getNews(Organization $organization, $count = 4)
    {
        $tags = $organization->categories->map(function ($catgory) {
            return Tag::query()->where('slug', $catgory->slug)->first()->id;
        })->toArray();

        $tags = array_merge($tags, [Tag::query()->where('slug', $organization->slug)->first()->id] ?? []);

        return News::query()->whereHas('tags', function (Builder $query) use ($tags) {
            $query->whereIn('id', $tags);
        })->orderBy('registered_at', 'DESC')->take($count)->get();
    }

    /**
     * Return the FAQ for the organization.
     */
    public static function getFAQ(Organization $organization)
    {
        $faq = [];

        // founded year
        if (!empty($organization->founded_year)) {
            $faq[] = [
                'question' => "<b>{$organization->title}</b>" . ' در چه سالی تاسیس شده است؟',
                'answer' => "<b>{$organization->title}</b>" . ' در سال ' . "<b>{$organization->founded_year}</b>" . ' تاسیس شده است.',
            ];
        }

        // city and primary_address
        if (!empty($organization->city->name)) {
            $fullAdress = (!empty($organization->primary_address))
                ? $organization->city->name . ' - ' . $organization->primary_address
                : $organization->city->name;
            $faq[] = [
                'question' => 'دفتر مرکزی ' . "<b>{$organization->title}</b>" . ' در کجا قرار دارد؟',
                'answer' => 'دفتر مرکزی ' . "<b>{$organization->title}</b>" . ' در ' . "<b>{$fullAdress}</b>" . ' قرار داد.'
            ];
        }

        // founders
        $founders = $organization->people()
            ->whereIn('job_id', [
                31, 36, 48, 83, 84, 484, 538, 540, 559, 560, 567, 716, 818, 820, 822, 888, 907, 917, 971, 1026, 1027, 1061, 1086, 1100, 1117, 1134, 1140, 1149, 1330, 1334, 1354
            ])->get();
        if (!empty($founders) && $founders->count() > 0) {
            $question = 'بنیان گذاران ' . "<b>{$organization->title}</b>" . ' چه کسانی هستند؟';
            $answer = '';

            $foundersList = [];

            foreach ($founders as $founder) {
                $foundersList[] = $founder->getFullName();
            }

            if (count($foundersList) == 1) {
                $answer = "<b>{$foundersList[0]}</b>" . ' بنیان گذار ' . "<b>{$organization->title}</b>" . ' است.';
            } elseif (count($foundersList) <= 3) {
                $string = implode('، ', $foundersList);
                $answer = "<b>{$string}</b>" . ' بنیان گذاران ' . "<b>{$organization->title}</b>" . ' هستند.';
            } elseif (count($foundersList) > 3) {
                $string = implode('، ', array_slice($foundersList, 0, 3)) . ' و ' . ((int) $founders->count() - 3) . ' نفر دیگر';
                $answer = "<b>{$string}</b>" . ' بنیان گذاران ' . "<b>{$organization->title}</b>" . ' هستند.';
            }

            $faq[] = [
                'question' => $question,
                'answer' => $answer
            ];
        }

        // investors
        $agreements = $organization->firstSideParty()->where('status', '<>', 'exit')->get();
        if (!empty($agreements) && $agreements->count() > 0) {
            $question = 'سرمایه گذاران ' . "<b>{$organization->title}</b>" . ' چه کسانی هستند؟';
            $answer = '';

            $investorsList = [];

            foreach ($agreements as $agreement) {
                $investorsList[] = $agreement->secondSideMembers()->first()->title ?? '';
            }

            $investorsList = array_filter(array_unique($investorsList));

            if (count($investorsList) == 1) {
                $answer = "<b>{$investorsList[0]}</b>" . ' سرمایه گذار ' . "<b>{$organization->title}</b>" . ' است.';
            } elseif (count($investorsList) <= 3) {
                $string = implode('، ', $investorsList);
                $answer = "<b>{$string}</b>" . ' سرمایه گذاران ' . "<b>{$organization->title}</b>" . ' هستند.';
            } elseif (count($investorsList) > 3) {
                $string = implode('، ', array_slice($investorsList, 0, 3)) . ' و ' . ((int) $agreements->count() - 3) . ' شرکت دیگر';
                $answer = "<b>{$string}</b>" . ' سرمایه گذاران ' . "<b>{$organization->title}</b>" . ' هستند.';
            }

            $faq[] = [
                'question' => $question,
                'answer' => $answer
            ];
        }

        return $faq;
    }
}
