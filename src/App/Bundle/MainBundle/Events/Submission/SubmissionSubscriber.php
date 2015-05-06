<?php

namespace App\Bundle\MainBundle\Events\Submission;

use App\Component\Clock\Clock;
use App\Component\Record\Record;
use App\Component\Record\WriterInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Listen to event concerning submissions
 */
class SubmissionSubscriber implements EventSubscriberInterface
{
    /**
     * The service used to save records
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
    public static function getSubscribedEvents()
    {
        return [
            SubmissionEvents::VALIDATED => 'onSubmissionValidated',
        ];
    }

    /**
     * Create records when a submission is validated
     *
     * @param ValidatedEvent $event
     */
    public function onSubmissionValidated(ValidatedEvent $event)
    {
        $submission = $event->getSubmission();
        $record     = new Record($submission->getRun(), $this->clock->now());

        $this->writer->save($record);
    }
}
