<?php

namespace App\Bundle\MainBundle\Services\Record;

use App\Component\Record\ReaderInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Read world records using Doctrine
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
    public function findAll()
    {
        $records  = [];
        $entities = $this->getRepository()->findAll();

        foreach ($entities as $entity) {
            $records[] = $this->converter->from($entity);
        }

        return $records;
    }

    /**
     * Retrieve the record entity repository
     *
     * @return \App\Bundle\MainBundle\Entity\Record\RecordRepository
     */
    private function getRepository()
    {
        return $this->entityManager->getRepository('AppMainBundle:Record\Record');
    }
}
