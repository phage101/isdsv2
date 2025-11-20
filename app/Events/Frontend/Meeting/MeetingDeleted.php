<?php

namespace App\Events\Frontend\Meeting;

use Illuminate\Queue\SerializesModels;

/**
 * Class MeetingDeleted.
 */
class MeetingDeleted
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
