<?php

namespace App\Bundle\MainBundle\Controller;

use App\Component\Vote\UpvoteCommand;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Handle actions about votes
 */
class VoteController extends Controller
{
    /**
     * Upvote an existing world record
     *
     * @param Request $request
     *
     * @Security("is_granted('ROLE_USER')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function upvoteAction(Request $request)
    {
        $identifier = $request->get('identifier');
        $username   = $this->getUser()->getUsername();

        $command = new UpvoteCommand($identifier, $username);
        $bus     = $this->getCommandBus();
        $bus->launch($command);

        $reader = $this->getReader();
        if ($reader->isUpvoted($identifier, $username)) {
            return $this->redirectToRoute('app_main_homepage');
        }

        $this->get('session')->getFlashBag()->add(
            'notice',
            $this->get('translator')->trans('vote.notice.upvote_failed')
        );

        return $this->redirectToRoute('app_main_homepage');
    }

    /**
     * Retrieve the vote command bus service
     *
     * @return \App\Component\Command\BusInterface
     */
    private function getCommandBus()
    {
        return $this->get('app_main.vote.command.bus');
    }

    /**
     * Retrieve the vote reader service
     *
     * @return \App\Component\Vote\ReaderInterface
     */
    private function getReader()
    {
        return $this->get('app_main.vote.reader');
    }
}
