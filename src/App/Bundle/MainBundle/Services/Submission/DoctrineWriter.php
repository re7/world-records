<?php

namespace App\Bundle\MainBundle\Services\Submission;

use App\Bundle\MainBundle\Entity\Submission as SubmissionEntity;
use App\Component\Submission\Submission;
use App\Component\Submission\WriterInterface;
use Doctrine\ORM\EntityManagerInterface;

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
     * __construct
     *
     * @param EntityManagerInterface $entityManager
     * @param EntityConverter        $converter
     */
    public function __construct(EntityManagerInterface $entityManager, EntityConverter $converter)
    {
        $this->entityManager = $entityManager;
        $this->converter     = $converter;
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
