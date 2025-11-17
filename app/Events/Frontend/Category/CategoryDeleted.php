<?php

namespace App\Events\Frontend\Category;

use Illuminate\Queue\SerializesModels;

/**
 * Class CategoryDeleted.
 */
class CategoryDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $category;

    /**
     * @param $category
     */
    public function __construct($category)
    {
        $this->category = $category;
    }
}
