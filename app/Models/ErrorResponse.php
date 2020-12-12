<?php


namespace App\Models;


class ErrorResponse
{
   public $code = "";
   public $message = "";
   public $type = "";

    /**
     * ErrorResponse constructor.
     * @param string $code
     * @param string $message
     * @param string $type
     */
    public function __construct(string $code, string $message, string $type)
    {
        $this->code = $code;
        $this->message = $message;
        $this->type = $type;
    }


}
