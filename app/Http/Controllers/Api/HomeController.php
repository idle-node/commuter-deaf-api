<?php

namespace App\Http\Controllers\Api;

use App\Model\CSM\Station;
use App\Facade\BaseResponse;
use App\Facade\Console;
use App\Http\Controllers\Controller;
use App\Model\CSM\StationSchedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request): JsonResponse {

        $this->baseValidator($request, [
            "latitude" => "required|gt:-90|lt:90",
            "longitude" => "required|gt:-180|lt:180"
        ]);

        /**
         * Nearest Station
         */

        $nearest_station = \DB::select(\DB::raw("
            SELECT
                id,
                deleted_at,
                `haversine_radius`
            FROM (
                SELECT *,
                (
                    (
                        (
                            acos(
                                sin(( {$request->get('latitude')} * pi() / 180 ))
                                *
                                sin(( `station_lat` * pi() / 180 )) + cos(( {$request->get('latitude')} * pi() / 180 ))
                                *
                                cos(( `station_lat` * pi() / 180 )) * cos((( {$request->get('longitude')} - `station_lng` ) * pi() / 180))
                            ) 
                        ) * 180 / pi()
                    ) * 60 * 1.1515 * 1.609344
                ) AS haversine_radius FROM csm_stations
            ) csm_stations
            WHERE 
                deleted_at IS NULL
            ORDER BY `haversine_radius`
        "))[0];

        Console::writeLine(json_encode($nearest_station));

        $station = Station::with([
                        'facilities'
                    ])
                    ->get()
                    ->find($nearest_station->id);            

        return BaseResponse::ok(
            [
                "station" => $station,
                "schedule" => StationSchedule
                                ::where('station_departure_id', $station->id)
                                ->with([
                                    'departure',
                                    'destination'
                                ])
                                ->take(3)
                                ->get()
            ],
            "Success getting home activity data"
        );
    }
}
