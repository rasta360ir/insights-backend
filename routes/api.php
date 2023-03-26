<?php

use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\SocialNetworkController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Admin\WebsiteLogController;
use App\Http\Controllers\ContactFormController;
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
});


/**
 * Application Routes
 */

// recommendations
//Route::get('recommendations', [RecommendationController::class, 'index']);

// contact forms
Route::apiResource('contact-forms', ContactFormController::class);
