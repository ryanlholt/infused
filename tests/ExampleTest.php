<?php

namespace RyanLHolt\Infused\Tests;

use Orchestra\Testbench\TestCase;
use RyanLHolt\Infused\InfusedServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [InfusedServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
