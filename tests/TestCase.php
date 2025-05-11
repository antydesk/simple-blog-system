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

        // Создаём password grant client
        Artisan::call('passport:client', [
            '--password' => true,
            '--name' => 'Test Password Client',
            '--no-interaction' => true,
        ]);

        // Получаем только password grant client
        $client = \Laravel\Passport\Client::query()->latest()->first();

        // Устанавливаем в конфиг, чтобы код из getPassportCredentials мог его получить
        Config::set('passport.personal_access_client.id', $client->id);
        Config::set('passport.personal_access_client.secret', $client->secret);
    }

}
