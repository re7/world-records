<?php

namespace App\Component\Security\Registration;

use App\Component\Command\CommandInterface;
use App\Component\Command\HandlerInterface;
use App\Component\Security\User\Exception\CreationFailedException;
use App\Component\Security\User\User;
use App\Component\Security\User\WriterInterface;

/**
 * Handle the security registration confirm command
 */
class ConfirmHandler implements HandlerInterface
{
    /**
     * The service used to write users in the storage engine
     *
     * @var WriterInterface
     */
    private $writer;

    /**
     * The service used to generate the security hash
     *
     * @var HashGeneratorInterface
     */
    private $hashGenerator;

    /**
     * __construct
     *
     * @param WriterInterface        $writer
     * @param HashGeneratorInterface $hashGenerator
     */
    public function __construct(WriterInterface $writer, HashGeneratorInterface $hashGenerator)
    {
        $this->writer        = $writer;
        $this->hashGenerator = $hashGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(CommandInterface $command)
    {
        $uuid          = $command->getUuid();
        $email         = $command->getEmail();
        $password      = $command->getPassword();
        $securityToken = $command->getSecurityToken();

        $referenceToken = $this->hashGenerator->hash($email, $password);
        if ($referenceToken === $securityToken) {
            $user = new User($uuid, $email, $password);

            try {
                $this->writer->create($user);
            } catch (CreationFailedException $exception) {
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getNameResolved()
    {
        return 'security_registration_confirm';
    }
}
