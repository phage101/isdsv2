<?php

namespace App\Events\Frontend\Status;

use Illuminate\Queue\SerializesModels;

/**
 * Class StatusUpdated.
 */
class StatusUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $status;

    /**
     * @param $status
     */
    public function __construct($status)
    {
        $this->status = $status;
    }
}
