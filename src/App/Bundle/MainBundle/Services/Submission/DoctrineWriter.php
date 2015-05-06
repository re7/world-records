<?php

namespace App\Bundle\MainBundle\Services\Submission;

use App\Bundle\MainBundle\Entity\Submission as SubmissionEntity;
use App\Bundle\MainBundle\Events\Submission\SubmissionEvents;
use App\Bundle\MainBundle\Events\Submission\ValidatedEvent;
use App\Component\Submission\Exceptions\ValidationFailedException;
use App\Component\Submission\Submission;
use App\Component\Submission\WriterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Write, edit and delete submissions using Doctrine
 */
class DoctrineWriter implements WriterInterface
{
    /**
     * The configured doctrine entity manager
     *
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * The service used to convert submissions from/to entities
     *
     * @var EntityConverter
     */
    private $converter;

    /**
     * The Symfony event dispatcher
     *
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * __construct
     *
     * @param EntityManagerInterface   $entityManager
     * @param EntityConverter          $converter
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        EntityConverter $converter,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->entityManager   = $entityManager;
        $this->converter       = $converter;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Submission $submission)
    {
        $entity = $this->find($submission->getIdentifier());

        $this->converter->computeTo($submission, $entity);
        $this->getRepository()->save($entity);

        $submission->setIdentifier($entity->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function validate($identifier)
    {
        $entity = $this->find($identifier);

        if ($entity === null || $entity->isValidated()) {
            throw new ValidationFailedException(sprintf('Cannot validate the submission "%s".', $identifier));
        }

        $entity->setValidated(true);
        $this->getRepository()->save($entity);

        $event = new ValidatedEvent($this->converter->from($entity));
        $this->eventDispatcher->dispatch(SubmissionEvents::VALIDATED, $event);
    }

    /**
     * Find a submission with the given identifier or create a new one if none
     * is found
     *
     * @param int|null $identifier
     *
     * @return SubmissionEntity
     */
    private function find($identifier = null)
    {
        $entity = null;

        if ($identifier !== null) {
            $entity = $this->getRepository()->find($identifier);
        }
        if ($entity === null) {
            $entity = new SubmissionEntity();
        }

        return $entity;
    }

    /**
     * Retrieve the submission entity repository
     *
     * @return \App\Bundle\MainBundle\Entity\SubmissionRepository
     */
    private function getRepository()
    {
        return $this->entityManager->getRepository('AppMainBundle:Submission');
    }
}
