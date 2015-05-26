<?php

namespace App\Component\Security\User;

/**
 * The service used to write security users
 */
interface WriterInterface
{
    /**
     * Retrieve the user having the given identifier
     *
     * @param User $user
     *
     * @throws \App\Component\Security\User\Exception\CreationFailedException
     */
    public function create(User $user);
}
