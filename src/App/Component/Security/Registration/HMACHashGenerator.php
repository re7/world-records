<?php

namespace App\Component\Security\Registration;

/**
 * Use HMAC to generate hashes
 */
class HMACHashGenerator implements HashGeneratorInterface
{
    /**
     * The secret key used to hash the message
     *
     * @var string
     */
    private $secretKey;

    /**
     * __construct
     *
     * @param string $secretKey
     */
    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * {@inheritdoc}
     */
    public function hash($email, $password)
    {
        $message = sprintf('email=%s&password=%s', $email, $password);

        $hash = hash_hmac('sha256', $message, $this->secretKey);

        return $hash;
    }
}
