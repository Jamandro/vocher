<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use App\Recipient;

class ApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApi()
    {
        /**
         * Invalid email
         */
        $response = $this->get(route('api.vouchers', 'johndoe.com'));

        $response->assertStatus(404);

        /**
         * Unregistered email
         */
        $response = $this->get(route('api.vouchers', 'john@doe.co'));

        $response->assertStatus(400);

        /**
         * Successful call
         */
        $response = $this->get(route('api.vouchers', 'john@doe.com'));

        $response->assertStatus(200);

        /**
         * Configure voucher_code to be a valid voucher for john@doe.com
         */
        $recipient = Recipient::where('email', 'john@doe.com')->first();
        $voucher_code_valid = $recipient->vouchers()->join('special_offers', 'special_offers.id', '=', 'voucher_codes.special_offer_id')->select('voucher_codes.code')->where('voucher_codes.recipient_id', $recipient->id)->where('special_offers.expiration', '>=', Carbon::today())->whereNull('voucher_codes.used_on')->first();
        $voucher_code_expired = $recipient->vouchers()->join('special_offers', 'special_offers.id', '=', 'voucher_codes.special_offer_id')->select('voucher_codes.code')->where('voucher_codes.recipient_id', $recipient->id)->where('special_offers.expiration', '<', Carbon::today())->whereNull('voucher_codes.used_on')->first();

        /**
         * No parameters
         */
        $response = $this->post(route('api.voucher'));

        $response->assertStatus(400);

        if ($voucher_code_expired) {
            /**
             * Expired voucher code
             */
            $response = $this->post(route('api.voucher'), [
                'email'         => $recipient->email,
                'voucher_code'  => $voucher_code_expired->code
            ]);

            $response->assertStatus(400);
        }

        /**
         * Missing email
         */
        $response = $this->post(route('api.voucher'), [
            'voucher_code'  => 'somecode'
        ]);

        $response->assertStatus(400);

        /**
         * Missing voucher_code
         */
        $response = $this->post(route('api.voucher'), [
            'email'         => $recipient->email,
        ]);

        $response->assertStatus(400);

        /**
         * Invalid email
         */
        $response = $this->post(route('api.voucher'), [
            'email'         => 'a' . $recipient->email,
            'voucher_code'  => 'somecode'
        ]);

        $response->assertStatus(400);

        /**
         * Invalid voucher_code
         */
        $response = $this->post(route('api.voucher'), [
            'email'         => $recipient->email,
            'voucher_code'  => 'somecode'
        ]);

        $response->assertStatus(400);


        if ($voucher_code_valid) {
            /**
             * Successful
             */
            $response = $this->post(route('api.voucher'), [
                'email'         => $recipient->email,
                'voucher_code'  => $voucher_code_valid->code
            ]);

            $response->assertStatus(200);

            /**
             * Just used voucher
             */
            $response = $this->post(route('api.voucher'), [
                'email'         => $recipient->email,
                'voucher_code'  => $voucher_code_valid->code
            ]);

            $response->assertStatus(400);
        }
    }
}
