<?php

namespace App\Component\Security\Registration;

/**
 * The service used to generate a security hash using a secret key
 */
interface HashGeneratorInterface
{
    /**
     * Generate a security hash for the given email and password
     *
     * @param string $email
     * @param string $password
     *
     * @return string
     */
    public function hash($email, $password);
}
