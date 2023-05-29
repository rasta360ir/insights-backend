<?php

use App\Http\Controllers\Admin\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {

    // Subscription Plans
    Route::apiResource('subscription-plans', SubscriptionController::class);
});
