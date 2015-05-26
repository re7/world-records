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
     * __construct
     *
     * @param string $username
     * @param string $password
     */
    public function __construct($identifier, $username, $password)
    {
        $this->identifier = $identifier;
        $this->username   = $username;
        $this->password   = $password;
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
}
