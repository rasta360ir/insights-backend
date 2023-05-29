<?php

use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\ApplicationLogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\HubController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\SocialNetworkController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Admin\WebsiteLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('customers', function () {
    $data = \App\Services\DataService::getCustomers();
    return response()->json($data, 200);
});


/**
 * Admin Routes
 */
Route::prefix('admin')->group(function () {

    // categories admin routes
    Route::apiResource('categories', CategoryController::class);
    Route::post('categories/{category}/restore', [CategoryController::class, 'restore'])
        ->name('categories.restore');
    Route::post('categories/{category}/remove', [CategoryController::class, 'remove'])
        ->name('categories.remove');

    // organizations admin routes
    Route::apiResource('organizations', OrganizationController::class);
    Route::post('organizations/{organization}/restore', [OrganizationController::class, 'restore'])
        ->name('organizations.restore');
    Route::post('organizations/{organization}/remove', [OrganizationController::class, 'remove'])
        ->name('organizations.remove');

    // websites admin routes
    Route::apiResource('organizations.websites', WebsiteController::class);
    Route::post('organizations/{organization}/websites/{website}/restore', [WebsiteController::class, 'restore'])
        ->name('organizations.websites.restore');
    Route::post('organizations/{organization}/websites/{website}/remove', [WebsiteController::class, 'remove'])
        ->name('organizations.websites.remove');

    // website logs admin routes
    Route::apiResource('websites.website-logs', WebsiteLogController::class)
        ->except(['index', 'show']);

    // applications admin routes
    Route::apiResource('organizations.applications', ApplicationController::class);
    Route::post('organizations/{organization}/applications/{application}/restore', [ApplicationController::class, 'restore'])
        ->name('organizations.applications.restore');
    Route::post('organizations/{organization}/applications/{application}/remove', [ApplicationController::class, 'remove'])
        ->name('organizations.applications.remove');

    // application logs admin routes
    Route::apiResource('applications.application-logs', ApplicationLogController::class)
        ->except(['index', 'show']);

    // social networks admin routes
    Route::apiResource('organizations.social-networks', SocialNetworkController::class);
    Route::post('organizations/{organization}/social-networks/{application}/restore', [SocialNetworkController::class, 'restore'])
        ->name('organizations.social-networks.restore');
    Route::post('organizations/{organization}/social-networks/{application}/remove', [SocialNetworkController::class, 'remove'])
        ->name('organizations.social-networks.remove');

    // news admin routes
    Route::apiResource('news', NewsController::class);
    Route::post('news/{news}/restore', [NewsController::class, 'restore'])
        ->name('news.restore');
    Route::post('news/{news}/remove', [NewsController::class, 'remove'])
        ->name('news.remove');

    // departments admin routes
    Route::apiResource('departments', DepartmentController::class);

    // jobs admin routes
    Route::apiResource('jobs', JobController::class);

    // people admin routes
    Route::apiResource('people', PersonController::class);
    Route::post('people/{person}/restore', [PersonController::class, 'restore'])
        ->name('people.restore');
    Route::post('people/{person}/remove', [PersonController::class, 'remove'])
        ->name('people.remove');

    // hubs admin routes
    Route::apiResource('hubs', HubController::class);
    Route::post('hubs/{hub}/restore', [HubController::class, 'restore'])
        ->name('hubs.restore');
    Route::post('hubs/{hub}/remove', [HubController::class, 'remove'])
        ->name('hubs.remove');

    // provinces
    Route::apiResource('provinces', ProvinceController::class);

    // cities
    Route::apiResource('cities', CityController::class);
});


/**
 * Application Routes
 */

// Store contact form
Route::post('contact-forms', [\App\Http\Controllers\Insights\ContactFormController::class, 'store']);

// recommendations
Route::get('recommendations', [\App\Http\Controllers\Insights\RecommendationsController::class, 'index']);

// hubs
Route::get('hubs', [\App\Http\Controllers\Insights\HubController::class, 'index']);

// search
Route::get('/search', [\App\Http\Controllers\Insights\SearchController::class, 'index']);


/**
 * Reports
 */
Route::get('reports/organizations/most-visited', [\App\Reports\OrganizationReport::class, 'mostVisited']);



/**
 * Data
 */
Route::get('organizations/status', [OrganizationController::class, 'getStatusItems']);
Route::get('organizations/type', [OrganizationController::class, 'getTypeItems']);
Route::get('organizations/profile-type', [OrganizationController::class, 'getProfileTypeItems']);
Route::get('organizations/ownership-type', [OrganizationController::class, 'getOwnershipTypeItems']);
Route::get('organizations/business-model', [OrganizationController::class, 'getBusinessModelItems']);
Route::get('organizations/ipo', [OrganizationController::class, 'getIpoItems']);

Route::get('date/jalali/months', [\App\Http\Controllers\JalaliDateController::class, 'getMonths']);


/**
 * Insights routes
 */
require __DIR__.'/insights.php';
require __DIR__.'/admin.php';
