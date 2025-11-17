<?php

namespace App\Events\Backend\PriorityLevel;

use Illuminate\Queue\SerializesModels;

/**
 * Class PriorityLevelCreated.
 */
class PriorityLevelCreated
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
