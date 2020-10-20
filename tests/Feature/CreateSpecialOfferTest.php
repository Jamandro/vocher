<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class CreateSpecialOfferTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateSpecialOffer()
    {
        $faker = \Faker\Factory::create();

        $name = $faker->sentence(4);
        $discount = $faker->numberBetween(1, 20) * 5;
        $expiration = $faker->dateTimeBetween('+1 days', '+5 months');

        /**
         * Required fields check
         */
        $response = $this->post(route('offer.create'), [
        ]);

        $response->assertSessionHasErrors(['name', 'discount', 'expiration']);

        /**
         * Discount must be numeric check
         */
        $response = $this->post(route('offer.create'), [
            'name'          => $name,
            'discount'      => 'asdasd',
            'expiration'    => $expiration
        ]);

        // Check errors returned
        $response->assertSessionHasErrors(['discount']);

        /**
         * Discount must be between 1 and 100
         */
        $response = $this->post(route('offer.create'), [
            'name'          => $name,
            'discount'      => 0,
            'expiration'    => $expiration
        ]);

        // Check errors returned
        $response->assertSessionHasErrors(['discount']);

        $response = $this->post(route('offer.create'), [
            'name'          => $name,
            'discount'      => 101,
            'expiration'    => $expiration
        ]);

        // Check errors returned
        $response->assertSessionHasErrors(['discount']);

        /**
         * Date must be a valid date
         */
        $response = $this->post(route('offer.create'), [
            'name'          => $name,
            'discount'      => $discount,
            'expiration'    => '30/02/2018'
        ]);

        // Check errors returned
        $response->assertSessionHasErrors(['expiration']);

        /**
         * Date must have d/m/Y format
         */
        $response = $this->post(route('offer.create'), [
            'name'          => $name,
            'discount'      => $discount,
            'expiration'    => '10/30/2020'
        ]);

        // Check errors returned
        $response->assertSessionHasErrors(['expiration']);

        /**
          * Date must be today or after
         */
        $response = $this->post(route('offer.create'), [
            'name'          => $name,
            'discount'      => $discount,
            'expiration'    => Carbon::yesterday()
        ]);

        // Check errors returned
        $response->assertSessionHasErrors(['expiration']);

        // Successful call
        $response = $this->post(route('offer.create'), [
            'name'          => $name,
            'discount'      => $discount,
            'expiration'    => $expiration
        ]);

        // Redirects after creating the Special Offer
        $response->assertStatus(302);
        $response->assertRedirect(route('index'));
    }
}
