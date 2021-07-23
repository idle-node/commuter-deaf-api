<?php


namespace App\Common\Exceptions;


use App\Repository\SLM\Impl\ErrorLogRepositoryImpl;
use Throwable;

/**
 * @author https://github.com/CuaMcCarsaree44
 * @since July, 7/24/2021 2021 03:08:17
 *
 * BaseException
 * Insert Description Here...
 */
class BaseException
{
    protected string $code;
    protected string $message;
    protected $data = null;

    public function __construct($message, $code, $data = null)
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;

        /**
         * Insert SLM Here
         */
        (new ErrorLogRepositoryImpl())->createErrorLog(
            substr($code, 0, 3),
            $code,
            $message
        );

        throw new \Error("Error $code : $message", 500);
    }
}
