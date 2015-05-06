<?php

namespace App\Bundle\MainBundle\Events\Submission;

use App\Component\Submission\Submission;
use Symfony\Component\EventDispatcher\Event;

/**
 * Reference the submission when dispatching the validated event
 */
class ValidatedEvent extends Event
{
    /**
     * The submission that has been validated
     *
     * @var Submission
     */
    private $submission;

    /**
     * __construct
     *
     * @param Submission $submission
     */
    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
    }

    /**
     * Get the validated submission
     *
     * @return Submission
     */
    public function getSubmission()
    {
        return $this->submission;
    }
}
