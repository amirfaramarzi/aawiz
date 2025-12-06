<?php

namespace Tests\V1\Evaluation\Get;

use App\V1\Enums\TestEnum;
use Fomo\Http\Http;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class FeatureTest extends TestCase
{
    public function testOne()
    {
        $client = new Http();
        $status = $client->withHeaders(['Authorization' => 'Bearer '.TestEnum::bearerToken->value])->get(TestEnum::baseUrl->value . 'evaluations')->status();

        assertEquals( 200, $status);
    }

    public function testTwo()
    {
        $client = new Http();
        $status = $client->withHeaders(['Authorization' => 'Bearer '.TestEnum::bearerToken->value])->get(TestEnum::baseUrl->value . 'evaluations?page=2')->status();

        assertEquals( 200, $status);
    }
}