<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Recipient;
use Carbon\Carbon;

class VoucherCodeController extends Controller
{
    /**
     * Use contructor to change locale to English
     * Only used for API m_responsekeys(conn, identifier)
     */
    public function __construct()
    {
        \App::setLocale('en');
    }

    /**
     * Retrieve the list of valid coupons for a given email
     * JSON response
     */
    public function list($email) {
        $recipient = Recipient::where('email', $email)->first();

        if ($recipient) {
            $voucherCodes = $recipient->vouchers()->join('special_offers', 'special_offers.id', '=', 'voucher_codes.special_offer_id')->whereNull('voucher_codes.used_on')->where('special_offers.expiration', '>=', Carbon::today())->get();

            $vouchers = [];
            foreach ($voucherCodes as $voucher) {
                $vouchers[] = [
                    'offer_name'    => $voucher->specialOffer->name,
                    'code'          => $voucher->code,
                    'discount'      => number_format($voucher->specialOffer->discount),
                    'expiration'    => $voucher->specialOffer->expiration->format('d-m-Y'),
                ];
            }

            return response()->json([
                'code'      => 200,
                'message'   => 'Successful',
                'vouchers'  => $vouchers
            ], 200);
        } else {
            return response()->json([
                'code'      => 400,
                'message'   => 'Invalid email address.'
            ], 400);
        }
    }

    /**
     * Given an email address and coupon code, retrieve discount and update used_on date
     */
    public function use(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email'         => 'required|email',
            'voucher_code'  => 'required|string|min:8'
        ]);

        if ($v->fails()) {
            return response()->json([
                'code'      => 400,
                'message'   => $v->errors()->first()
            ], 400);
        }

        $recipient = Recipient::where('email', $request->input('email'))->first();

        if (!$recipient) {
            return response()->json([
                'code'      => 400,
                'message'   => 'Invalid email address.'
            ], 400);
        }

        $voucherCode = $recipient->vouchers()->select(['voucher_codes.id', 'special_offers.discount'])->join('special_offers', 'special_offers.id', '=', 'voucher_codes.special_offer_id')->where('voucher_codes.code', $request->input('voucher_code'))->whereNull('voucher_codes.used_on')->where('special_offers.expiration', '>=', Carbon::today())->first();

        if (!$voucherCode) {
            return response()->json([
                'code'      => 400,
                'message'   => 'Invalid voucher code.'
            ], 400);
        }

        \DB::table('voucher_codes')
            ->where('id', $voucherCode->id)
            ->update(['used_on' => Carbon::now()]);

        return response()->json([
            'code'      => 200,
            'message'   => 'Successful',
            'discount'  => number_format($voucherCode->discount, 2)
        ]);
    }
}
