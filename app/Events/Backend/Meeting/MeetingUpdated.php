<?php

namespace App\Events\Backend\Meeting;

use Illuminate\Queue\SerializesModels;

/**
 * Class MeetingUpdated.
 */
class MeetingUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $meeting;

    /**
     * @param $meeting
     */
    public function __construct($meeting)
    {
        $this->meeting = $meeting;
    }
}
