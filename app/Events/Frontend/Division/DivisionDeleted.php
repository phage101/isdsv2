<?php

namespace App\Events\Frontend\Division;

use Illuminate\Queue\SerializesModels;

/**
 * Class DivisionDeleted.
 */
class DivisionDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $division;

    /**
     * @param $division
     */
    public function __construct($division)
    {
        $this->division = $division;
    }
}
