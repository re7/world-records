<?php

namespace App\Bundle\MainBundle\Services\Submission;

use App\Bundle\MainBundle\Form\Model\Submission as FormSubmission;
use App\Component\Clock\Clock;
use App\Component\Run\Player;
use App\Component\Run\Run;
use App\Component\Run\Thumbnailer\ThumbnailerInterface;
use App\Component\Submission\Submission;

/**
 * Create submissions from form submissions
 */
class SubmissionFactory
{
    /**
     * The application clock
     *
     * @var Clock
     */
    private $clock;

    /**
     * __construct
     *
     * @param Clock                $clock
     * @param ThumbnailerInterface $thumbnailer
     */
    public function __construct(Clock $clock, ThumbnailerInterface $thumbnailer)
    {
        $this->clock       = $clock;
        $this->thumbnailer = $thumbnailer;
    }

    /**
     * Create a new submission from the given form submission
     *
     * @param FormSubmission $formSubmission
     *
     * @return Submission
     */
    public function create(FormSubmission $formSubmission)
    {
        $now       = $this->clock->now();
        $thumbnail = $this->thumbnailer->find($formSubmission->getLink());

        $player     = new Player(
            $formSubmission->getPlayerName(),
            $formSubmission->getPlayerLink()
        );
        $run        = new Run(
            $player,
            $formSubmission->getGame(),
            $formSubmission->getCategory(),
            [$formSubmission->getLink()],
            $formSubmission->getPlatform(),
            $formSubmission->getTime(),
            $formSubmission->getDate(),
            $thumbnail
        );
        $submission = new Submission(
            $run,
            $now,
            $now
        );

        return $submission;
    }
}
