<?php


namespace App\Repository\SLM\Impl;


use App\Model\SLM\ErrorLog;
use App\Repository\SLM\ErrorLogRepository;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 7/24/2021 2021 03:22:28
 *
 * ErrorLogRepositoryImpl
 * Insert Description Here...
 */
class ErrorLogRepositoryImpl implements ErrorLogRepository
{

    public function createErrorLog(string $module, string $code, string $message): void
    {
        $log = new ErrorLog();
        $log->module = $module;
        $log->code = $code;
        $log->description = $message;
        $log->created_at = new \DateTime();
        $log->save();
    }

    public function readErrorLog($constaint): array
    {
        throw new Error("readErrorLog not implemented yet!");
        // TODO: Implement readErrorLog() method.
    }
}
