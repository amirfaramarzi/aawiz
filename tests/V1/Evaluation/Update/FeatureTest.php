<?php

namespace Tests\V1\Evaluation\Update;

use App\V1\Enums\TestEnum;
use Fomo\Http\Http;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class FeatureTest extends TestCase
{
    public function testOne()
    {
        $client = new Http();
        $status = $client->withHeaders(['Authorization' => 'Bearer '.$this->getAdminToken()])->patch(TestEnum::baseUrl->value . 'evaluations/8798' , [
            'title' => generateRandomString(10),
            'description' => generateRandomString(10),
        ])->status();

        assertEquals( 404, $status);
    }
}