<?php

namespace App\Bundle\MainBundle\Events\Submission;

/**
 * Reference all existing submission events
 */
final class SubmissionEvents
{
    /**
     * The event dispatched when a submission is validated
     */
    const VALIDATED = 'app_main.event.submission.validated';
}
