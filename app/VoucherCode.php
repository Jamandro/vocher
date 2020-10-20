<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherCode extends Model
{
    /**
     * Parse as Carbon date
     */
    protected $dates = ['used_on'];

    /**
     * Enable fields for mass assignment
     */
    protected $fillable = ['special_offer_id', 'recipient_id', 'code'];

    /**
     * Create voucher codes for special oofer and given recipients
     * Return number of created vouchers
     */
    public static function createBatch(SpecialOffer $specialOffer, $recipients)
    {
        $count = 0;
        foreach($recipients AS $recipient) {
            if (get_class($recipient) == 'App\Recipient') {
                $voucherCode = new VoucherCode([
                    'special_offer_id'  => $specialOffer->id,
                    'recipient_id'      => $recipient->id,
                    'code'              => str_random(12),
                ]);
                $voucherCode->save();

                $count++;

                /**
                 * Code to send E-mail with voucher here
                 * Can also create a queue for improved mailing delivery
                 */
            }
        }

        return $count;
    }

    /**
     * Get recipient in voucher
     */
    public function recipient() {
        return $this->belongsTo(Recipient::class);
    }

    /**
     * Get offer in voucher
     */
    public function specialOffer() {
        return $this->belongsTo(SpecialOffer::class);
    }
}
