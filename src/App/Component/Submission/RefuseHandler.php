<?php

namespace App\Component\Submission;

use App\Component\Command\CommandInterface;
use App\Component\Command\HandlerInterface;
use App\Component\Submission\Exceptions\RefusalFailedException;

/**
 * Handle the submission refuse command
 */
class RefuseHandler implements HandlerInterface
{
    /**
     * The service used to write submissions in the storage engine
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
            $this->writer->refuse($identifier);
        } catch (RefusalFailedException $exception) {
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getNameResolved()
    {
        return 'submission_refuse';
    }
}
