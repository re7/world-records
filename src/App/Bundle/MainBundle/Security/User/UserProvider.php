<?php

namespace App\Bundle\MainBundle\Security\User;

use App\Component\Security\User\ReaderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * The service used to provide security users
 */
class UserProvider implements UserProviderInterface
{
    /**
     * The service used to access users from a database
     *
     * @var ReaderInterface
     */
    private $reader;

    /**
     * __construct
     *
     * @param ReaderInterface $reader
     */
    public function __construct(ReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        $user = $this->reader->findByUsername($username);

        if ($user !== null) {
            $password = $user->getPassword();
            $salt     = null;
            $roles    = [$user->isModerator() ? 'ROLE_MODERATOR' : 'ROLE_USER'];

            return new User($username, $password, $salt, $roles);
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return $class === 'App\Bundle\MainBundle\Security\User\User';
    }
}
