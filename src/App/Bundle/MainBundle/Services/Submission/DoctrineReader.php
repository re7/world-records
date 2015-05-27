<?php

namespace App\Bundle\MainBundle\Services\Submission;

use App\Bundle\MainBundle\Entity\Submission as SubmissionEntity;
use App\Component\Submission\ReaderInterface;
use App\Component\Submission\Submission;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Read submissions using Doctrine
 */
class DoctrineReader implements ReaderInterface
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
    public function findAllNotValidated()
    {
        $submissions = [];
        $entities    = $this->getRepository()->findAllNotValidated();

        foreach ($entities as $entity) {
            $submissions[] = $this->converter->from($entity);
        }

        return $submissions;
    }

    /**
     * {@inheritdoc}
     */
    public function findByIdentifier($identifier)
    {
        $entity = $this->getRepository()->findByIdentifier($identifier);

        $submission = $this->converter->from($entity);

        return $submission;
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
