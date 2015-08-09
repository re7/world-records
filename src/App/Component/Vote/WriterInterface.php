<?php

namespace App\Component\Vote;

/**
 * The service to perform write, edit and delete operations about votes on the
 * database
 */
interface WriterInterface
{
    /**
     * Create an upvote for the given world record and user
     *
     * @param int       $object
     * @param string    $username
     * @param \DateTime $date
     *
     * @throws \App\Component\Vote\Exceptions\UpvoteFailedException
     */
    public function upvote($object, $username, \DateTime $date);
}
