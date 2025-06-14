<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Laravel\Passport\Client;

abstract class TestCase extends BaseTestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $client = Client::query()->where('name', 'Test Password Client')->first();

        if (!$client) {
            Artisan::call('passport:client', [
                '--password' => true,
                '--name' => 'Test Password Client',
                '--no-interaction' => true,
            ]);
            $client = Client::query()->where('name', 'Test Password Client')->first();
        }

        Config::set('passport.personal_access_client.id', $client->id);
        Config::set('passport.personal_access_client.secret', $client->secret);
    }

}
