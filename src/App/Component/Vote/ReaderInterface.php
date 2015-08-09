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

    /**
     * Check if each reference is voted by the given user. Return an array
     * indexed by reference
     *
     * @param int[]       $references
     * @param string|null $username
     *
     * @return bool[]
     */
    public function voted(array $references, $username = null);

    /**
     * Check if there is already a vote for the given object and username
     *
     * @param int    $object
     * @param string $username
     *
     * @return bool
     */
    public function isUpvoted($object, $username);
}
