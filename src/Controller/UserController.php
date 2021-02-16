<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueil(): Response
    {
        return $this->render('base.html.twig');
    }



    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $participant = new Participant();
        $inscriptionForm = $this->createForm(InscriptionType::class, $participant);
        $inscriptionForm ->handleRequest($request);
        if ($inscriptionForm -> isSubmitted() && $inscriptionForm->isValid())
        {
            $em->persist($participant);
            $em->flush();

            $this->addFlash('success', 'L\'utilisateur a bien été enregistré !');
            return $this->redirectToRoute('accueil', ['id'=> $participant->getId()]);
        }

        return $this->render('user/inscription.html.twig', ["inscriptionForm" => $inscriptionForm->createView() ]);
    }
}
