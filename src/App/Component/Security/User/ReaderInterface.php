<?php

namespace App\Component\Security\User;

/**
 * The service used to read security users
 */
interface ReaderInterface
{
    /**
     * Retrieve the user having the given username
     *
     * @param string $username
     *
     * @return User|null
     */
    public function findByUsername($username);

    /**
     * Retrieve the user having the given identifier
     *
     * @param string $identifier
     *
     * @return User|null
     */
    public function findByIdentifier($identifier);
}
