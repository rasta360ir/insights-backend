<?php

use App\Http\Controllers\Admin\SubscriptionPlanController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {

    // Subscription Plans
    Route::apiResource('subscription-plans', SubscriptionPlanController::class);
});
