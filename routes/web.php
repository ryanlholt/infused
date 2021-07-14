<?php

use Illuminate\Support\Facades\Route;
use RyanLHolt\Infused\Http\Controllers\InfusionsoftController;

Route::group(['middleware' => ['auth','web']], function () {
    Route::get(config('infused.infusionsoftAuthorize'), [InfusionsoftController::class, 'finishAuthorize']);
    Route::get(config('infused.infusionsoftSettings'), [InfusionsoftController::class, 'settings'])
              ->name('infused.infusionsoft.settings');
});
