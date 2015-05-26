<?php

namespace App\Component\Security\Registration;

use App\Component\Command\CommandInterface;

/**
 * Confirm the registration
 */
class ConfirmCommand implements CommandInterface
{
    /**
     * The unique user id
     *
     * @var string
     */
    private $uuid;

    /**
     * The unique email
     *
     * @var string
     */
    private $email;

    /**
     * The encoded password
     *
     * @var string
     */
    private $password;

    /**
     * The security token used to verify that informations were send by the
     * application
     *
     * @var string
     */
    private $securityToken;

    /**
     * __construct
     *
     * @param string $uuid
     * @param string $email
     * @param string $password
     * @param string $securityToken
     */
    public function __construct($uuid, $email, $password, $securityToken)
    {
        $this->uuid          = $uuid;
        $this->email         = $email;
        $this->password      = $password;
        $this->securityToken = $securityToken;
    }

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
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
     * Get securityToken
     *
     * @return string
     */
    public function getSecurityToken()
    {
        return $this->securityToken;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'security_registration_confirm';
    }
}
