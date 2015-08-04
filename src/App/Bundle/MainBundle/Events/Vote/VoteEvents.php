<?php

namespace App\Bundle\MainBundle\Events\Vote;

/**
 * Reference all existing vote events
 */
final class VoteEvents
{
    /**
     * The event dispatched when a world record is upvoted
     */
    const UPVOTED = 'app_main.event.vote.upvoted';
}
