<?php

namespace App\Events\Backend\Status;

use Illuminate\Queue\SerializesModels;

/**
 * Class StatusCreated.
 */
class StatusCreated
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
