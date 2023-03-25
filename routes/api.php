<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Application\RecommendationController;
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
    Route::apiResource('departments', DepartmentController::class);

    // categories admin routes
    Route::apiResource('categories', CategoryController::class);
    Route::post('categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::post('categories/{category}/remove', [CategoryController::class, 'remove'])->name('categories.remove');

    // organizations admin routes
    Route::apiResource('organizations', OrganizationController::class);
    Route::post('organizations/{organization}/restore', [OrganizationController::class, 'restore'])->name('organizations.restore');
    Route::post('organizations/{organization}/remove', [OrganizationController::class, 'remove'])->name('organizations.remove');
});


/**
 * Application Routes
 */

// recommendations
Route::get('recommendations', [RecommendationController::class, 'index']);

// contact forms
Route::apiResource('contact-forms', ContactFormController::class);
