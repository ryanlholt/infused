<?php

use RyanLHolt\Infused\Http\Controllers\InfusionsoftController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function () {
    Route::get('/infusionsoft/callback', [InfusionsoftController::class, 'storeToken']);
});
