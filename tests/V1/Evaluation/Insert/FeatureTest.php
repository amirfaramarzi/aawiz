<?php

namespace Tests\V1\Evaluation\Insert;

use App\V1\Enums\TestEnum;
use Fomo\Http\Http;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class FeatureTest extends TestCase
{
    public function testOne()
    {
        $client = new Http();
        $status = $client->withHeaders(['Authorization' => 'Bearer '.$this->getAdminToken()])->post(TestEnum::baseUrl->value . 'evaluations' , [
            'title' => generateRandomString(10),
            'description' => generateRandomString(10),
        ])->status();

        assertEquals( 201, $status);
    }
    public function testTwo()
    {
        $client = new Http();
        $status = $client->withHeaders(['Authorization' => 'Bearer '.$this->getAdminToken() . 'a'])->post(TestEnum::baseUrl->value . 'evaluations' , [
            'title' => generateRandomString(10),
            'description' => generateRandomString(10),
        ])->status();

        assertEquals( 401, $status);
    }

    public function testThree()
    {
        $client = new Http();
        $status = $client->withHeaders(['Authorization' => 'Bearer '.$this->getAdminToken()])->post(TestEnum::baseUrl->value . 'evaluations' , [
            'title' => generateRandomString(1000),
            'description' => generateRandomString(10),
        ])->status();

        assertEquals( 422, $status);
    }
}