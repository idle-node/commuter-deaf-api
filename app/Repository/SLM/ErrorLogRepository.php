<?php


namespace App\Repository\SLM;


/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 7/24/2021 2021 03:18:26
 *
 * ErrorLogRepository
 * Insert Description Here...
 */
interface ErrorLogRepository
{
    /**
     * createErrorLog
     *
     * A repository to write new Error Log
     * Should be run Asynchronously if possible.
     *
     * @param string $module
     * @param string $code
     * @param string $message
     */
    public function createErrorLog(string $module, string $code, string $message): void;

    /**
     * readErrorLog
     *
     * A repository to get error log.
     * Constraint is Eloquent Where Statement object.
     *
     * @param $constaint
     * @return array
     */
    public function readErrorLog($constaint): array;
}
