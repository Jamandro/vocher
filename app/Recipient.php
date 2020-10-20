<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    /**
     * Get vouchers for recipient
     */
    public function vouchers()
    {
        return $this->hasMany(VoucherCode::class);
    }
}
