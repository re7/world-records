<?php

namespace App\Component\Security\User;

use App\Component\Command\CommandInterface;
use App\Component\Command\HandlerInterface;

/**
 * Handle the security user promote command
 */
class PromoteHandler implements HandlerInterface
{
    /**
     * The service used to write users in the storage engine
     *
     * @var WriterInterface
     */
    private $writer;

    /**
     * __construct
     *
     * @param WriterInterface $writer
     */
    public function __construct(WriterInterface $writer)
    {
        $this->writer = $writer;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(CommandInterface $command)
    {
        $identifier = $command->getIdentifier();

        try {
            $this->writer->promote($identifier);
        } catch (PromotionFailedException $exception) {
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getNameResolved()
    {
        return 'security_user_promote';
    }
}
