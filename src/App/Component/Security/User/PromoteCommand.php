<?php

namespace App\Component\Security\User;

use App\Component\Command\CommandInterface;

/**
 * Promote user as moderator
 */
class PromoteCommand implements CommandInterface
{
    /**
     * The unique identifier of the user to promote
     *
     * @var string
     */
    private $identifier;

    /**
     * __construct
     *
     * @param string $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'security_user_promote';
    }
}
