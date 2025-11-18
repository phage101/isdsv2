<?php

namespace App\Events\Frontend\ClientType;

use Illuminate\Queue\SerializesModels;

/**
 * Class ClientTypeUpdated.
 */
class ClientTypeUpdated
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
