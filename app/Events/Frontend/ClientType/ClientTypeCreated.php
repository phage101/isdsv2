<?php

namespace App\Events\Frontend\ClientType;

use Illuminate\Queue\SerializesModels;

/**
 * Class ClientTypeCreated.
 */
class ClientTypeCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $clientType;

    /**
     * @param $clientType
     */
    public function __construct($clientType)
    {
        $this->clientType = $clientType;
    }
}
