<?php

namespace App\Bundle\MainBundle\Services\Security\User;

use App\Bundle\MainBundle\Entity\Security\User as UserEntity;
use App\Component\Security\User\ReaderInterface;
use App\Component\Security\User\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Read security users using Doctrine
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
    public function findByUsername($username)
    {
        $entity = $this->getRepository()->findByUsername($username);

        return $this->createUserFromEntity($entity);
    }

    /**
     * {@inheritdoc}
     */
    public function findByIdentifier($identifier)
    {
        $entity = $this->getRepository()->findByUuid($identifier);

        return $this->createUserFromEntity($entity);
    }

    /**
     * Retrieve the user entity repository
     *
     * @return \App\Bundle\MainBundle\Entity\Security\UserRepository
     */
    private function getRepository()
    {
        return $this->entityManager->getRepository('AppMainBundle:Security\User');
    }

    /**
     * Create a security user from the given entity
     *
     * @param UserEntity $entity
     *
     * @return User
     */
    private function createUserFromEntity(UserEntity $entity)
    {
        if ($entity === null) {
            return null;
        }

        $user = new User(
            $entity->getUuid(),
            $entity->getUsername(),
            $entity->getPassword(),
            $entity->isModerator()
        );

        return $user;
    }
}
