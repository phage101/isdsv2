<?php

namespace App\Events\Frontend\Division;

use Illuminate\Queue\SerializesModels;

/**
 * Class DivisionCreated.
 */
class DivisionCreated
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
