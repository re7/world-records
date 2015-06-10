<?php

namespace App\Bundle\MainBundle\Security\User;

use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * A security user
 */
class User implements UserInterface, EquatableInterface
{
    /**
     * The unique identifier of this user
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
     * The salt used to encode the password
     *
     * @var string
     */
    private $salt;

    /**
     * The roles of this user
     *
     * @var string[]
     */
    private $roles;

    /**
     * __construct
     *
     * @param string   $username
     * @param string   $password
     * @param string   $salt
     * @param string[] $roles
     */
    public function __construct($username, $password, $salt, array $roles)
    {
        $this->username = $username;
        $this->password = $password;
        $this->salt     = $salt;
        $this->roles    = $roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function isEqualTo(UserInterface $user)
    {
        return (
            $user instanceof self
            && $this->password === $user->getPassword()
            && $this->salt === $user->getSalt()
            && $this->username === $user->getUsername()
        );

        return false;
    }
}
