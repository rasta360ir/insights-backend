<?php

// FAQ routes
Route::get('faq', [\App\Http\Controllers\Insights\FAQController::class, 'index']);

// Organization routes
Route::get('organizations',
    [\App\Http\Controllers\Insights\OrganizationController::class, 'index']);

Route::get('/organizations/{organization:slug}',
    [\App\Http\Controllers\Insights\OrganizationController::class, 'show']);

Route::get('/organizations/{organization:slug}/statistics',
    [\App\Http\Controllers\Insights\OrganizationController::class, 'statistics']);

Route::get('/organizations/{organization:slug}/people',
    [\App\Http\Controllers\Insights\OrganizationController::class, 'people']);

Route::get('organizations/{organization:slug}/competitors',
    [\App\Http\Controllers\Insights\OrganizationController::class, 'competitors']);

Route::get('organizations/{organization:slug}/financial',
    [\App\Http\Controllers\Insights\OrganizationController::class, 'financial']);

Route::get('organizations/{organization:slug}/news',
    [\App\Http\Controllers\Insights\OrganizationController::class, 'news']);

Route::get('organizations/{organization:slug}/faq',
    [\App\Http\Controllers\Insights\OrganizationController::class, 'faq']);

// Advanced search routes
Route::post('advanced-search/organizations',
    [\App\Http\Controllers\Insights\AdvancedSearchController::class, 'organizations']);

