<?php

namespace RyanLHolt\Infused;

class Infused
{
    protected $app;
    protected $infusionsoft;

    public function __construct($app){
        $this->app = $app;

        $this->infusionsoft = $this->app->make('infusionsoft');
    }

    public function updateToken($token){
        dd($token);
    }
}
