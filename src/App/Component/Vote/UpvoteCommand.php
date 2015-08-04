<?php

namespace App\Component\Vote;

use App\Component\Command\CommandInterface;

/**
 * Upvote a world record
 */
class UpvoteCommand implements CommandInterface
{
    /**
     * The unique identifier of the object to upvote
     *
     * @var int
     */
    private $object;

    /**
     * The unique username of the user upvoting
     *
     * @var string
     */
    private $username;

    /**
     * __construct
     *
     * @param int    $object
     * @param string $username
     */
    public function __construct($object, $username)
    {
        $this->object   = $object;
        $this->username = $username;
    }

    /**
     * Get object
     *
     * @return int
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'vote_upvote';
    }
}
