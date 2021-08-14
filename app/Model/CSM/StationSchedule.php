<?php

namespace App\Model\CSM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StationSchedule extends Model
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
        'deleted_at',
        'station_departure_id',
        'station_destination_id'
    ];

    protected $table = "csm_station_schedule_mappings";

    public function departure() {
        return $this->hasOne('App\Model\CSM\Station', 'id', 'station_departure_id');
    }

    public function destination() {
        return $this->hasOne('App\Model\CSM\Station', 'id', 'station_destination_id');
    }
}
