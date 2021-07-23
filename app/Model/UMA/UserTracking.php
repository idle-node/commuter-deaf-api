<?php


namespace App\Model\UMA;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 24 2021 03:03:13
 *
 * UserTracking
 * Insert Description Here...
 */
class UserTracking extends Model
{

    use SoftDeletes;

    public $timestamps = false;

    /**
     * @protected
     * @var array
     */
    protected $hidden = [
        'created_at',
        'deleted_at'
    ];
}
