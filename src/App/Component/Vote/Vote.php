<?php

namespace App\Component\Vote;

/**
 * A vote on an object
 */
class Vote
{
    /**
     * The unique identifier of the object voted
     *
     * @var int
     */
    private $object;

    /**
     * The username of the user voting
     *
     * @var string
     */
    private $username;

    /**
     * The creation date of this vote
     *
     * @var \DateTime
     */
    private $createdAt;

    /**
     * __construct
     *
     * @param int       $object
     * @param string    $username
     * @param \DateTime $createdAt
     */
    public function __construct($object, $username, \DateTime $createdAt)
    {
        $this->object    = $object;
        $this->username  = $username;
        $this->createdAt = $createdAt;
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
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
