<?php

use App\Http\Controllers\Admin\DepartmentController;
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

Route::prefix('admin')->group(function () {
    Route::apiResource('departments', DepartmentController::class);
});


Route::get('customers', function () {
    $data = \App\Services\DataService::getCustomers();
    return response()->json($data, 200);
});


// contact forms
Route::apiResource('contact-forms', ContactFormController::class);
