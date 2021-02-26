<?php

use Illuminate\Support\Facades\Route;
use RyanLHolt\Infused\Http\Controllers\InfusionsoftController;

Route::group(['middleware' => ['web']], function () {
    Route::get('/infusionsoft/callback', [InfusionsoftController::class, 'storeToken']);
    Route::get('/infused', [InfusionsoftController::class, 'settings']);
});
