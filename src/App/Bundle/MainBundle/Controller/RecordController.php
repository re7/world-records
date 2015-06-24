<?php

namespace App\Bundle\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Handle actions about record
 */
class RecordController extends Controller
{
    const NUMBER_PER_PAGE = 20;

    /**
     * List all records ordered by date
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request)
    {
        $page        = $request->get('page', 1);
        $elements    = $this->get('app_main.record.lister.date')->get(self::NUMBER_PER_PAGE, $page);
        if (count($elements) === 0) {
            throw $this->createNotFoundException();
        }
        $isNextPage  = (count($elements) === self::NUMBER_PER_PAGE);
        $identifiers = $this->getIdentifiers($elements);
        $records     = $this->get('app_main.record.reader')->find($identifiers);

        $orderedRecords = $this->getOrderedRecords($elements, $records);

        return $this->render('AppMainBundle:Record:list.html.twig', [
            'records'  => $orderedRecords,
            'nextPage' => ($isNextPage ? $page + 1 : null),
        ]);
    }

    /**
     * Retrieve record identifiers from the given elements array
     *
     * @param \App\Component\Lister\Element[] $elements
     *
     * @return int[]
     */
    private function getIdentifiers(array $elements)
    {
        $identifiers = [];

        foreach ($elements as $element) {
            $identifiers[] = $element->getIdentifier();
        }

        return $identifiers;
    }

    /**
     * Construct the list of ordered records using elements to get the order and
     * records to get objects
     *
     * @param int[]                          $elements
     * @param \App\Component\Record\Record[] $records
     *
     * @param \App\Component\Record\Record[]
     */
    private function getOrderedRecords(array $elements, array $records)
    {
        $orderedRecords = [];

        foreach ($elements as $element) {
            $orderedRecords[] = $records[$element->getIdentifier()];
        }

        return $orderedRecords;
    }
}
