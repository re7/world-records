<?php

namespace App\Bundle\MainBundle\Services\Record;

use App\Bundle\MainBundle\Entity\Record\Record as RecordEntity;
use App\Component\Record\Record;
use App\Component\Record\WriterInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Write, edit and delete records using Doctrine
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
     * The service used to convert records from/to entities
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
    public function save(Record $record)
    {
        $entity = $this->find($record->getIdentifier());

        $this->converter->computeTo($record, $entity);
        $this->getRepository()->save($entity);

        $record->setIdentifier($entity->getIdentifier());
    }

    /**
     * Find a record with the given identifier or create a new one if none is
     * found
     *
     * @param int|null $identifier
     *
     * @return RecordEntity
     */
    private function find($identifier = null)
    {
        $entity = null;

        if ($identifier !== null) {
            $entity = $this->getRepository()->find($identifier);
        }
        if ($entity === null) {
            $entity = new RecordEntity();
        }

        return $entity;
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
