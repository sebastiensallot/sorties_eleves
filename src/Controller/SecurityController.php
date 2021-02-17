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

class SecurityController extends AbstractController

{

    /**
     * @Route("/connexion", name="connexion")
     */
    public function login(): Response

    {

        if ($this->getUser())
            return $this->redirectToRoute('accueil');


        return $this->render('user/connexion.html.twig');
    }


    /**
     * Symfony gère entièrement cette route
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }

}

