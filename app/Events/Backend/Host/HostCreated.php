<?php

namespace App\Events\Backend\Host;

use Illuminate\Queue\SerializesModels;

/**
 * Class HostCreated.
 */
class HostCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $host;

    /**
     * @param $host
     */
    public function __construct($host)
    {
        $this->host = $host;
    }
}
