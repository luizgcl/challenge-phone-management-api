<?php

use App\Http\Controllers\PhoneNumberController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('phone-numbers', PhoneNumberController::class, [
        'only' => ['index', 'store', 'show', 'update', 'destroy'],
    ]);
});
