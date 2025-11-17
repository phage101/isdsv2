<?php

namespace App\Events\Frontend\RequestType;

use Illuminate\Queue\SerializesModels;

/**
 * Class RequestTypeCreated.
 */
class RequestTypeCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $requestType;

    /**
     * @param $requestType
     */
    public function __construct($requestType)
    {
        $this->requestType = $requestType;
    }
}
