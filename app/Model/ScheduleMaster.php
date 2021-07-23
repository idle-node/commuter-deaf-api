<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 24 2021 03:04:25
 *
 * ScheduleMaster
 * Insert Description Here...
 */
class ScheduleMaster extends Model
{

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

    protected $table = "csm_schedule_master";
}
