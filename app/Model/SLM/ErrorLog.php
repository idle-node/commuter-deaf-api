<?php


namespace App\Model\SLM;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 24 2021 03:03:49
 *
 * ErrorLog
 * Insert Description Here...
 */
class ErrorLog extends Model
{
    public $timestamps = false;

    /**
     * @protected
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $table = "slm_error_log";
}
