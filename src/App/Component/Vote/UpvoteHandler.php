<?php

namespace App\Component\Vote;

use App\Component\Clock\Clock;
use App\Component\Command\CommandInterface;
use App\Component\Command\HandlerInterface;
use App\Component\Vote\Exceptions\UpvoteFailedException;

/**
 * Handle the world record upvote command
 */
class UpvoteHandler implements HandlerInterface
{
    /**
     * The service used to write votes in the storage engine
     *
     * @var WriterInterface
     */
    private $writer;

    /**
     * The application clock
     *
     * @var Clock
     */
    private $clock;

    /**
     * __construct
     *
     * @param WriterInterface $writer
     * @param Clock           $clock
     */
    public function __construct(WriterInterface $writer, Clock $clock)
    {
        $this->writer = $writer;
        $this->clock  = $clock;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(CommandInterface $command)
    {
        $object   = $command->getObject();
        $username = $command->getUsername();
        $now      = $this->clock->now();

        try {
            $this->writer->upvote($object, $username, $now);
        } catch (UpvoteFailedException $exception) {
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getNameResolved()
    {
        return 'vote_upvote';
    }
}
