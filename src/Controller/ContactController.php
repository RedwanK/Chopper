<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact_request")
     */
    public function contact(Request $request, \Swift_Mailer $mailer, $contactMail)
    {
        if ($request->getMethod() != "POST") {
            throw new NotFoundHttpException();
        }

        $message = (new \Swift_Message('Prise de contact'))
            ->setFrom($request->request->get('email'))
            ->setTo($contactMail)
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'emails/contact.html.twig',
                    [
                        'name' => $request->request->get('name') !=  null ? $request->request->get('name') : "",
                        'email' => $request->request->get('email') !=  null ? $request->request->get('email') : "",
                        'phone' => $request->request->get('phone') !=  null ? $request->request->get('phone') : "",
                        'company' => $request->request->get('company') !=  null ? $request->request->get('company') : "",
                        'message' => $request->request->get('message') !=  null ? $request->request->get('message') : "",
                    ]
                ),
                'text/html'
            )
        ;

        $mailer->send($message);

        return $this->redirectToRoute('home');
    }
}
