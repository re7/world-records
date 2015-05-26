<?php

namespace App\Bundle\MainBundle\Services\Security\User;

use App\Bundle\MainBundle\Entity\Security\User as UserEntity;
use App\Component\Security\User\Exception\CreationFailedException;
use App\Component\Security\User\User;
use App\Component\Security\User\WriterInterface;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Write security users using Doctrine
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
     * {@inheritdoc}
     */
    public function create(User $user)
    {
        $entity = new UserEntity();
        $entity
            ->setUuid($user->getIdentifier())
            ->setUsername($user->getUsername())
            ->setPassword($user->getPassword())
        ;

        try {
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        } catch (DBALException $exception) {
            throw new CreationFailedException();
        }
    }
}
