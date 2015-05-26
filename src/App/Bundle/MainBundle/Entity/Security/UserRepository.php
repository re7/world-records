<?php

namespace App\Bundle\MainBundle\Entity\Security;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    /**
     * Retrieve the user having the given username
     *
     * @param string $username
     *
     * @return User|null
     */
    public function findByUsername($username)
    {
        $builder = $this->createQueryBuilder('user');
        $builder
            ->where('user.username = :username')
            ->setParameter('username', $username)
        ;

        return $builder->getQuery()->getOneOrNullResult();
    }

    /**
     * Retrieve the user having the given uuid
     *
     * @param string $uuid
     *
     * @return User|null
     */
    public function findByUuid($uuid)
    {
        $builder = $this->createQueryBuilder('user');
        $builder
            ->where('user.uuid = :uuid')
            ->setParameter('uuid', $uuid)
        ;

        return $builder->getQuery()->getOneOrNullResult();
    }
}
