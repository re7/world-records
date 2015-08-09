<?php

namespace App\Bundle\MainBundle\Events\Vote;

use App\Component\Vote\Vote;
use Symfony\Component\EventDispatcher\Event;

/**
 * Reference the vote when dispatching the upvoted event
 */
class UpvotedEvent extends Event
{
    /**
     * The vote that has been created
     *
     * @var Vote
     */
    private $vote;

    /**
     * __construct
     *
     * @param Vote $vote
     */
    public function __construct(Vote $vote)
    {
        $this->vote = $vote;
    }

    /**
     * Get the vote
     *
     * @return Vote
     */
    public function getVote()
    {
        return $this->vote;
    }
}
