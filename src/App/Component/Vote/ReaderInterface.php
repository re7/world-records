<?php

namespace App\Component\Vote;

/**
 * The service to perform read operations about votes on the database
 */
interface ReaderInterface
{
    /**
     * Retrieve the number of vote for each reference. Return an array indexed
     * by reference
     *
     * @param int[] $references
     *
     * @return int[]
     */
    public function count(array $references);
}
