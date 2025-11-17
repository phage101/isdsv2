<?php

namespace App\Events\Backend\Medium;

use Illuminate\Queue\SerializesModels;

/**
 * Class MediumCreated.
 */
class MediumCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $medium;

    /**
     * @param $medium
     */
    public function __construct($medium)
    {
        $this->medium = $medium;
    }
}
