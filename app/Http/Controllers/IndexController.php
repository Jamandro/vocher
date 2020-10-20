<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VoucherCode;

class IndexController extends Controller
{
    /**
     * Show index page
     */
    public function show()
    {
        $vouchers = VoucherCode::orderBy('created_at', 'DESC')->get();
        $vouchers_unused = VoucherCode::whereNull('used_on')->count();

        return view('index', [
            'vouchers'          => $vouchers,
            'vouchers_total'    => number_format(count($vouchers), 0, '', '.'),
            'vouchers_unused'   => number_format($vouchers_unused, 0, '', '.'),
            'vouchers_used'     => number_format(count($vouchers) - $vouchers_unused, 0, '', '.')
        ]);
    }
}
