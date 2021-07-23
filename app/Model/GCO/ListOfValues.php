<?php


namespace App\Model\GCO;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 24 2021 03:03:28
 *
 * ListOfValues
 * Insert Description Here...
 */
class ListOfValues extends Model
{

    use SoftDeletes;

    public $timestamps = false;

    /**
     * @protected
     * @var array
     */
    protected $hidden = [
        'created_at',
    ];

    protected $table = "gco_list_of_values";
}
