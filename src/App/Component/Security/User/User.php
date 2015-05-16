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
     * @var int|null
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
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Set identifier
     *
     * @param int|null $identifier
     *
     * @return self
     */
    public function setIdentifier($identifier = null)
    {
        $this->identifier = $identifier;

        return $this;
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
