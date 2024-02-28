<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Contact;
use App\Form\ContactType;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function news(Request $r, EntityManagerInterface $m): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($r);

        $msg = null;
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $contact->setDate(new \DateTime("now"));
                $contact->setRead(false);

                $m->persist($contact);
                $m->flush();

                $msg = 'Success!';
            }
            else {
                $msg = 'Error!';
            }
        }

        return $this->render('contact.html.twig', [
            'form' => $form,
            'msg' => $msg,
        ] + BaseController::getBase($m));
    }
}