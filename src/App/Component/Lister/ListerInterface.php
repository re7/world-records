<?php

namespace App\Component\Lister;

/**
 * The service used to retrieve the order of all elements of a paginated list
 */
interface ListerInterface
{
    /**
     * Retrieve the array of elements for the given page, indexed by their
     * position
     *
     * @param int $page
     *
     * @return Element[]
     */
    public function get($page = 1);
}
