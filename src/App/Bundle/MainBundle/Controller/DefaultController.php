<?php

namespace App\Bundle\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $username    = ($this->getUser() ? $this->getUser()->getUsername() : null);
        $elements    = $this->get('app_main.record.lister.date')->get(RecordController::NUMBER_PER_PAGE);
        $isNextPage  = (count($elements) === RecordController::NUMBER_PER_PAGE);
        $identifiers = $this->getIdentifiers($elements);
        $records     = $this->get('app_main.record.index.aggregator')->get($identifiers, $username);

        $orderedRecords = $this->getOrderedRecords($elements, $records);

        return $this->render('AppMainBundle:Record:list.html.twig', [
            'records'  => $orderedRecords,
            'nextPage' => ($isNextPage ? 2 : null),
        ]);
    }

    /**
     * The action to render the piwik tracking code
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function piwikAction()
    {
        $siteId     = $this->container->hasParameter('piwik.site_id') ? $this->container->getParameter('piwik.site_id') : null;
        $trackerUrl = $this->container->hasParameter('piwik.tracker_url') ? $this->container->getParameter('piwik.tracker_url') : null;

        return $this->render('AppMainBundle:Default:piwik.html.twig', [
            'siteId'     => $siteId,
            'trackerUrl' => $trackerUrl,
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
     * @param int[]                                $elements
     * @param \App\Component\Record\Index\Record[] $records
     *
     * @param \App\Component\Record\Index\Record[]
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
