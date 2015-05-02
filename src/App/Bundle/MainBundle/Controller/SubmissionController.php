<?php

namespace App\Bundle\MainBundle\Controller;

use App\Bundle\MainBundle\Form\Model\Link;
use App\Bundle\MainBundle\Form\Type\LinkType;
use App\Bundle\MainBundle\Form\Model\Submission as FormSubmission;
use App\Bundle\MainBundle\Form\Type\SubmissionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestException;

/**
 * Handle actions about submission
 */
class SubmissionController extends Controller
{
    /**
     * Submit a new world record
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function submitAction(Request $request)
    {
        $link           = new Link();
        $linkForm       = $this->createForm(new LinkType(), $link);
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
            'form'     => $form->createView(),
            'linkForm' => $linkForm->createView(),
        ]);
    }

    /**
     * List all submissions waiting for validation
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $reader = $this->get('app_main.submission.reader');

        $submissions = $reader->findAllNotValidated();

        return $this->render('AppMainBundle:Submission:list.html.twig', [
            'submissions' => $submissions,
        ]);
    }

    /**
     * Validate the submission having the given identifier
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function validateAction(Request $request)
    {
        $identifier = $request->get('identifier');
        $this->get('app_main.submission.writer')->validate($identifier);

        $this->get('session')->getFlashBag()->add(
            'notice',
            $this->get('translator')->trans('submission.notice.validated')
        );

        return $this->redirectToRoute('app_main_submission_list');
    }

    /**
     * Autocomplete a submission
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function autocompleteAction(Request $request)
    {
        $link = new Link();
        $form = $this->createForm(new LinkType(), $link);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // @TODO Retrieve and format known data from the given link
            $data = ['link' => $link->getUrl()];

            return new JsonResponse($data);
        }

        throw new BadRequestException();
    }
}
