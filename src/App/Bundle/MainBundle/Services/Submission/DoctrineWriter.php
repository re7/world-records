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
     * __construct
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Save the given submission in database and update its identifier
     *
     * @param Submission $submission
     */
    public function save(Submission $submission)
    {
        $entity = $this->find($submission->getIdentifier());

        $this->compute($submission, $entity);
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
     * Compute data from the given submission in the given submission entity
     *
     * @param Submission       $submission
     * @param SubmissionEntity $entity
     */
    private function compute(Submission $submission, SubmissionEntity $entity)
    {
        $run    = $submission->getRun();
        $player = $run->getPlayer();

        $entity
            ->setPlayerName($player->getName())
            ->setPlayerLink($player->getLink())
            ->setGame($run->getGame())
            ->setCategory($run->getCategory())
            ->setLinks($run->getLinks())
            ->setPlatform($run->getPlatform())
            ->setTime($run->getTime())
            ->setDate($run->getDate())
            ->setCreatedAt($submission->getCreatedAt())
            ->setUpdatedAt($submission->getUpdatedAt())
            ->setValidated($submission->isValidated())
        ;
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
