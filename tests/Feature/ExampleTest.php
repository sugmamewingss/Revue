<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
<<<<<<< Updated upstream
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
=======
    public function test_the_application_returns_a_successful_response(): void
>>>>>>> Stashed changes
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
