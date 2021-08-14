<?php


namespace App\Model\UMA;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 24 2021 03:02:20
 *
 * User
 * Insert Description Here...
 */
class User extends Model
{
    /**
     * @static
     * 
     * Slug to determine user's status
     */
    const ACTIVATED = 1;
    const NOT_ACTIVATED = 0;
    const SUSPENDED = 2;
    const BANNED = 3;

    use SoftDeletes;

    public $timestamps = true;

    /**
     * @protected
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $table = "uma_users";
}
