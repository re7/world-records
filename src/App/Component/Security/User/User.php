<?php

namespace App\Component\Security\User;

/**
 * A security user
 */
class User
{
    /**
     * The unique identifier
     *
     * @var string
     */
    private $identifier;

    /**
     * The unique username
     *
     * @var string
     */
    private $username;

    /**
     * The encoded password of this user
     *
     * @var string
     */
    private $password;

    /**
     * Whether this user is a moderator
     *
     * @var bool
     */
    private $moderator;

    /**
     * __construct
     *
     * @param string $identifier
     * @param string $username
     * @param string $password
     * @param bool   $moderator
     */
    public function __construct($identifier, $username, $password, $moderator = false)
    {
        $this->identifier = $identifier;
        $this->username   = $username;
        $this->password   = $password;
        $this->moderator  = $moderator;
    }

    /**
     * Set identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
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
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get moderator
     *
     * @return bool
     */
    public function isModerator()
    {
        return $this->moderator;
    }
}
