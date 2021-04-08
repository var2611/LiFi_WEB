<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function test()
    {
        self::expectNotToPerformAssertions();
//        (new UserController())->demo();

        $response = $this->json('post', '/api/smsToMobile', [
            'mobile' => '8460113626'
        ]);


        print_r( ($response->dump()));


//        $response->assertOk();


    }
}
