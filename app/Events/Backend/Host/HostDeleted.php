<?php

namespace App\Events\Backend\Host;

use Illuminate\Queue\SerializesModels;

/**
 * Class HostDeleted.
 */
class HostDeleted
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
