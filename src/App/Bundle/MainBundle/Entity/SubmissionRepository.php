<?php

namespace App\Bundle\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SubmissionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SubmissionRepository extends EntityRepository
{
    /**
     * Save the given entity in database
     *
     * @param Submission $submission
     */
    public function save(Submission $submission)
    {
        $this->getEntityManager()->persist($submission);
        $this->getEntityManager()->flush($submission);
    }

    /**
     * Retrieve all submissions that are not validated yet
     *
     * @return Submission[]
     */
    public function findAllNotValidated()
    {
        $builder = $this->createQueryBuilder('submission');
        $builder
            ->where('submission.validated = FALSE')
            ->orderBy('submission.createdAt', 'DESC')
        ;

        return $builder->getQuery()->getResult();
    }
}
