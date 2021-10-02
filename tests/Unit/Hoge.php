<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @return void
     */
    public function testBasic2Test()
    {
        $response = $this->get('/');
        $response->assertStatus(500);
    }
}
