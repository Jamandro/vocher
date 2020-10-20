<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laracasts\Integrated\Extensions\Laravel;

class ViewsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexShowViews()
    {
        $response = $this->get(route('index'));

        $response->assertStatus(200);
        $response->assertViewIs('index');

        $response = $this->get(route('offer.create'));

        $response->assertStatus(200);
        $response->assertViewIs('offer.create');
    }
}
