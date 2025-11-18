<?php

namespace App\Events\Backend\Division;

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
