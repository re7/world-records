<?php

namespace App\Bundle\MainBundle\Services\Vote;

use App\Component\Vote\ReaderInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Read votes using Doctrine
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
     * __construct
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function count(array $references)
    {
        $counts = [];

        foreach ($references as $reference) {
            $counts[$reference] = 0;
        }

        $entities = $this->getCompiledRepository()->findCollection($references);
        foreach ($entities as $entity) {
            $counts[$entity->getReference()] = $entity->getQuantity();
        }

        return $counts;
    }

    /**
     * {@inheritdoc}
     */
    public function isUpvoted($object, $username)
    {
        return $this->getVoteRepository()->voteExists($object, $username);
    }

    /**
     * Retrieve the vote compiled entity repository
     *
     * @return \App\Bundle\MainBundle\Entity\Vote\CompiledRepository
     */
    private function getCompiledRepository()
    {
        return $this->entityManager->getRepository('AppMainBundle:Vote\Compiled');
    }

    /**
     * Retrieve the vote entity repository
     *
     * @return \App\Bundle\MainBundle\Entity\Vote\VoteRepository
     */
    private function getVoteRepository()
    {
        return $this->entityManager->getRepository('AppMainBundle:Vote\Vote');
    }
}
