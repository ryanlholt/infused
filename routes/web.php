<?php

use Illuminate\Support\Facades\Route;
use RyanLHolt\Infused\Http\Controllers\InfusionsoftController;

Route::group(['middleware' => ['web']], function () {
    // Route::get('/infusionsoft/callback', [InfusionsoftController::class, 'storeToken']);
    Route::get(config('infused.infusionsoft.redirectUri'), [InfusionsoftController::class, 'finishAuthorize']);
    Route::get(
        config('infused.infusionsoftSettings'),
        [InfusionsoftController::class, 'settings']
    )->name('infused.infusionsoft.settings');
});
