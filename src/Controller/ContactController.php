<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Envoi d'un e-mail
            $email = (new Email())
                ->from($data['email'])
                ->to('fatima.ndiaye1@ism.edu.sn')
                ->subject('Nouveau message de contact')
                ->html($this->renderView(
                    'emails/contact.html.twig',
                    ['data' => $data]
                ));

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a été envoyé avec succès.');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}