<?php

namespace App\Events\Frontend\Meeting;

use Illuminate\Queue\SerializesModels;

/**
 * Class MeetingCreated.
 */
class MeetingCreated
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
