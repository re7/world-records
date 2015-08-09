<?php

namespace App\Component\Record\Index;

/**
 * Aggregate data from readers to create record list objects
 */
interface AggregatorInterface
{
    /**
     * Retrieve the array of record list objects for the given identifiers, and
     * given username if not null
     *
     * @param int[]       $identifiers
     * @param string|null $username
     *
     * @return Record[]
     */
    public function get(array $identifiers, $username = null);
}
