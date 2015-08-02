<?php

namespace App\Component\Record\Index;

/**
 * Aggregate data from readers to create record list objects
 */
interface AggregatorInterface
{
    /**
     * Retrieve the array of record list objects for the given identifiers
     *
     * @param int[] $identifiers
     *
     * @return Record[]
     */
    public function get(array $identifiers);
}
