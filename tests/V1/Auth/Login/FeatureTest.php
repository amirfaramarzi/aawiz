<?php

namespace Tests\V1\Auth\Login;

use App\V1\Enums\TestEnum;
use Fomo\Http\Http;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class FeatureTest extends TestCase
{
    public function testOne()
    {
        $client = new Http();
        $status = $client->post(TestEnum::baseUrl->value . 'auth/login' , [
            'email' => 'user@gmail.com',
            'password' => 'user',
        ])->status();

        assertEquals( 200, $status);
    }
}