<?php

namespace App\Bundle\MainBundle\Services\Record\Lister;

use App\Component\Lister\Element;
use App\Component\Lister\ListerInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * List records by date
 */
class DateLister implements ListerInterface
{
    /**
     * The configured doctrine entity manager
     *
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * The number of element on each page
     *
     * @var int
     */
    private $numberPerPage;

    /**
     * __construct
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->numberPerPage = 10;
    }

    /**
     * {@inheritdoc}
     */
    public function get($page = 1)
    {
        $offset             = ($page - 1) * $this->numberPerPage;
        $orderedIdentifiers = $this->getRepository()->paginateByDate($this->numberPerPage, $offset);

        $elements = [];
        $position = 0;
        foreach ($orderedIdentifiers as $identifier) {
            $elements[$position] = new Element($identifier);
            $position++;
        }

        return $elements;
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
