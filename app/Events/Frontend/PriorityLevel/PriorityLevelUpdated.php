<?php

namespace App\Events\Frontend\PriorityLevel;

use Illuminate\Queue\SerializesModels;

/**
 * Class PriorityLevelUpdated.
 */
class PriorityLevelUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $priorityLevel;

    /**
     * @param $priorityLevel
     */
    public function __construct($priorityLevel)
    {
        $this->priorityLevel = $priorityLevel;
    }
}
