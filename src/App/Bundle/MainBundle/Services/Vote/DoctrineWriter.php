<?php

namespace App\Bundle\MainBundle\Services\Vote;

use App\Bundle\MainBundle\Entity\Vote\Vote as VoteEntity;
use App\Bundle\MainBundle\Events\Vote\VoteEvents;
use App\Bundle\MainBundle\Events\Vote\UpvotedEvent;
use App\Component\Vote\Exceptions\UpvoteFailedException;
use App\Component\Vote\WriterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Write, edit and delete votes using Doctrine
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
     * The service used to convert votes from entities
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
    public function upvote($object, $username, \DateTime $date)
    {
        if ($this->getRepository()->voteExists($object, $username)) {
            throw new UpvoteFailedException(sprintf('Cannot upvote the object "%s".', $object));
        }

        $entity = new VoteEntity();
        $entity
            ->setObject($object)
            ->setUsername($username)
            ->setCreatedAt($date)
        ;
        $this->getRepository()->save($entity);

        $event = new UpvotedEvent($this->converter->from($entity));
        $this->eventDispatcher->dispatch(VoteEvents::UPVOTED, $event);
    }

    /**
     * Retrieve the vote entity repository
     *
     * @return \App\Bundle\MainBundle\Entity\Vote\VoteRepository
     */
    private function getRepository()
    {
        return $this->entityManager->getRepository('AppMainBundle:Vote\Vote');
    }
}
