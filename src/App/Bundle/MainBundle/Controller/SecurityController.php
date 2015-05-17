<?php

namespace App\Bundle\MainBundle\Controller;

use App\Bundle\MainBundle\Form\Model\Security\Registration;
use App\Bundle\MainBundle\Form\Type\Security\RegistrationType;
use App\Bundle\MainBundle\Security\User\User;
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
            $this->sendConfirmationEmail($registration);

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

    /**
     * Send the confirmation email for the given registration
     *
     * @param Registration $registration
     */
    private function sendConfirmationEmail(Registration $registration)
    {
        $encoder         = $this->container->get('security.password_encoder');
        $encodedPassword = $encoder->encodePassword(
            new User(null, null, null, []),
            $registration->password
        );
        $hasher          = $this->container->get('app_main.security.registration.hash_generator');
        $securityToken   = $hasher->hash($registration->email, $encodedPassword);

        $subject = $this->get('translator')->trans('security.registration.confirmation_email.title');
        $content = $this->renderView(
            'AppMainBundle:Security:Registration/confirmationEmail.html.twig',
            [
                'email'         => $registration->email,
                'password'      => $encodedPassword,
                'securityToken' => $securityToken,
            ]
        );

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('wr@re-7.com')
            ->setTo($registration->email)
            ->setBody($content)
        ;
        $this->get('mailer')->send($message);
    }
}
