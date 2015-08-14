<?php

namespace App\Bundle\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Handle the menu bar content
 */
class MenuController extends Controller
{
    /**
     * Display the main menu bar
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function menuAction(Request $request)
    {
        $reader = $this->get('app_main.submission.reader');

        $submissions = $reader->countAllNotValidated();

        return $this->render('AppMainBundle:Menu:menu.html.twig', [
            'submissions' => $submissions,
        ]);
    }
}
