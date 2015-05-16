<?php

namespace App\Bundle\MainBundle\Services\Security\User;

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

        if ($entity === null) {
            return null;
        }

        $user = new User(
            $entity->getUsername(),
            $entity->getPassword()
        );
        $user->setIdentifier($entity->getIdentifier());

        return $user;
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
}
