<?php

namespace App\Bundle\MainBundle\Entity\Security;

use Doctrine\ORM\Mapping as ORM;

/**
 * The security user
 *
 * @ORM\Entity(repositoryClass="App\Bundle\MainBundle\Entity\Security\UserRepository")
 * @ORM\Table(name="security_user")
 */
class User
{
    /**
     * The unique identifier
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $identifier;

    /**
     * The unique user identifier generated by the app
     *
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=255, unique=true)
     */
    private $uuid;

    /**
     * The unique username
     *
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * The encoded password of this user
     *
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * Whether the user is a moderator
     *
     * @var bool
     *
     * @ORM\Column(name="moderator", type="boolean", options={"default" = "0"})
     */
    private $moderator = false;

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set uuid
     *
     * @param string $uuid
     *
     * @return self
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

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
     * Set username
     *
     * @param string
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
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
     * Set password
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
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

    /**
     * Set moderator
     *
     * @param bool $moderator
     *
     * @return self
     */
    public function setModerator($moderator)
    {
        $this->moderator = $moderator;

        return $this;
    }
}
