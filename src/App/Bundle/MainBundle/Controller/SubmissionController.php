<?php

namespace App\Bundle\MainBundle\Controller;

use App\Bundle\MainBundle\Form\Model\Submission as FormSubmission;
use App\Bundle\MainBundle\Form\Type\SubmissionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SubmissionController extends Controller
{
    public function submitAction(Request $request)
    {
        $formSubmission = new FormSubmission();
        $form           = $this->createForm(new SubmissionType(), $formSubmission);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $submission = $this->get('app_main.submission.factory')->create($formSubmission);
            $this->get('app_main.submission.writer')->save($submission);

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
