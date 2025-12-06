<?php

namespace Tests;

use App\V1\Enums\TestEnum;
use Fomo\Http\Http;
use Fomo\Test\Test;

class TestCase extends Test
{
    public function getAdminToken() : string
    {
        $client = new Http();
        return $client->post(TestEnum::baseUrl->value . 'auth/login' , [
            'email' => 'admin@gmail.com',
            'password' => 'admin',
        ])->json()['token'];
    }

    public function getUserToken() : string 
    {
        $client = new Http();
        return $client->post(TestEnum::baseUrl->value . 'auth/login' , [
            'email' => 'user@gmail.com',
            'password' => 'user',
        ])->json()['token'];
    }
}