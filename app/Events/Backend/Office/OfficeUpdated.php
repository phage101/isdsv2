<?php

namespace App\Events\Backend\Office;

use Illuminate\Queue\SerializesModels;

/**
 * Class OfficeUpdated.
 */
class OfficeUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $office;

    /**
     * @param $office
     */
    public function __construct($office)
    {
        $this->office = $office;
    }
}
