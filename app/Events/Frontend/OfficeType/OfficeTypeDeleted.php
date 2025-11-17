<?php

namespace App\Events\Frontend\OfficeType;

use Illuminate\Queue\SerializesModels;

/**
 * Class OfficeTypeDeleted.
 */
class OfficeTypeDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $office_types;

    /**
     * @param $office_types
     */
    public function __construct($office_types)
    {
        $this->office_types = $office_types;
    }
}
