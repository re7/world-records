<?php

namespace App\Bundle\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $records = $this->get('app_main.record.reader')->findAll();

        return $this->render('AppMainBundle:Default:index.html.twig', [
            'records' => $records,
        ]);
    }
}
