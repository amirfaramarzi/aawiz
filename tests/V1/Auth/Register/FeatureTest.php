<?php

namespace Tests\V1\Auth\Register;

use App\V1\Enums\TestEnum;
use Fomo\Http\Http;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class FeatureTest extends TestCase
{
    public function testOne()
    {
        $client = new Http();
        $status = $client->post(TestEnum::baseUrl->value . 'auth/register' , [
            'first_name' => generateRandomString(10),
            'last_name' => generateRandomString(10),
            'email' => generateRandomString(10). '@gmail.com',
            'password' => generateRandomString(10),
        ])->status();

        assertEquals( 201, $status);
    }
}