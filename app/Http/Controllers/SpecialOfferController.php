<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Recipient;
use App\SpecialOffer;
use App\VoucherCode;

class SpecialOfferController extends Controller
{
    /**
     * Show form to create new special offer
     */
    public function create()
    {
        return view('offer.create');
    }

    /**
     * Save new offer and create vouchers
     */
    public function save(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'discount'      => 'required|numeric|between:1,100',
            'expiration'    => 'required|date_format:d/m/Y',
        ]);

        /**
         * For some reason putting both validations together keeps throwing an error in phpunit tests
         */
        $this->validate($request, [
            'expiration'    => 'required|date_format:d/m/Y|after:yesterday',
        ]);

        $specialOffer = new SpecialOffer([
            'name'          => $request->input('name'),
            'discount'      => $request->input('discount'),
            'expiration'    => Carbon::createFromFormat('d/m/Y', $request->input('expiration')),
        ]);
        $specialOffer->save();

        $recipients = Recipient::get();
        $created = VoucherCode::createBatch($specialOffer, $recipients);

        \Session::flash('flash_message', $created . 'Vouchers were created');

        return redirect()->route('index');
    }
}
