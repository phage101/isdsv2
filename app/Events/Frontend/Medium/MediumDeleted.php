<?php

namespace App\Events\Frontend\Medium;

use Illuminate\Queue\SerializesModels;

/**
 * Class MediumDeleted.
 */
class MediumDeleted
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
