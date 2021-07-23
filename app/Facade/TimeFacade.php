<?php


namespace App\Facade;


/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 7/24/2021 2021 03:52:10
 *
 * TimeFacade
 * Insert Description Here...
 */
class TimeFacade
{
    public function getStringifiedEpochTime(): string {
        return date("d-m-Y H:i:s");
    }
}
