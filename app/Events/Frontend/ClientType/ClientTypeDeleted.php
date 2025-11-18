<?php

namespace App\Events\Frontend\ClientType;

use Illuminate\Queue\SerializesModels;

/**
 * Class ClientTypeDeleted.
 */
class ClientTypeDeleted
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
