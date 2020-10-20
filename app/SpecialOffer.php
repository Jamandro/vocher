<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
    /**
     * Parse as Carbon date
     */
    protected $dates = ['expiration'];

    /**
     * Enable fields for mass assignment
     */
    protected $fillable = ['name', 'discount', 'expiration'];

    /**
     * Get vouchers for offer
     */
    public function vouchers()
    {
        return $this->hasMany(VoucherCode::class);
    }
}
