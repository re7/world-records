<?php

namespace App\Bundle\MainBundle\Controller;

use App\Bundle\MainBundle\Form\Model\Submission;
use App\Bundle\MainBundle\Form\Type\SubmissionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SubmissionController extends Controller
{
    public function submitAction(Request $request)
    {
        $submission = new Submission();
        $form       = $this->createForm(new SubmissionType(), $submission);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('session')->getFlashBag()->add(
                'notice',
                $this->get('translator')->trans('submission.notice.submitted')
            );

            return $this->redirectToRoute('app_main_homepage');
        }

        return $this->render('AppMainBundle:Submission:submit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
