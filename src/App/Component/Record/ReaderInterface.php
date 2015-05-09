<?php

namespace App\Component\Record;

/**
 * The service to perform read operations about world records on the database
 */
interface ReaderInterface
{
    /**
     * Retrieve an array of world records having the given identifiers, indexed
     * by identifier
     *
     * @param int[]
     *
     * @return Record[]
     */
    public function find(array $identifiers);
}
