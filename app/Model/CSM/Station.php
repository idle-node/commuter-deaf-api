<?php

namespace App\Model\CSM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Station extends Model
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

    protected $table = "csm_stations";

    public function facilities() {
        return $this->hasMany('App\Model\FMA\Facility', 'station_id', 'id');
    }

    
}
