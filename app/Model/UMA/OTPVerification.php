<?php


namespace App\Model\UMA;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 24 2021 03:02:45
 *
 * OTPVerification
 * Insert Description Here...
 */
class OTPVerification extends Model
{
    public $timestamps = false;

    /**
     * @protected
     * @var array
     */
    protected $hidden = [
        'created_at',
    ];

    protected $table = "uma_otp_verification";
}
