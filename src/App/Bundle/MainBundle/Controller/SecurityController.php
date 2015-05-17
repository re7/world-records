<?php

namespace App\Bundle\MainBundle\Controller;

use App\Bundle\MainBundle\Form\Model\Security\Registration;
use App\Bundle\MainBundle\Form\Type\Security\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Handle security actions
 */
class SecurityController extends Controller
{
    /**
     * Log the user in
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'AppMainBundle:Security:login.html.twig',
            [
                'last_username' => $lastUsername,
                'error'         => $error,
            ]
        );
    }

    /**
     * Empty action, used to validate the route. The security system will handle
     * the request
     */
    public function loginCheckAction()
    {
    }

    /**
     * Send a confirmation email to create a new user account
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $registration = new Registration();
        $form         = $this->createForm(new RegistrationType(), $registration);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // @TODO Send the confirmation email

            $this->get('session')->getFlashBag()->add(
                'notice',
                $this->get('translator')->trans('security.register.notice.confirm')
            );

            return $this->redirectToRoute('app_main_homepage');
        }

        return $this->render('AppMainBundle:Security:register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
