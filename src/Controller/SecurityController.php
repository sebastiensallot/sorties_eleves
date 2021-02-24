<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SecurityController extends AbstractController

{
    /**
     * @Route("/connexion", name="login")
     */
    public function login(): Response

    {
        return $this->render('user/connexion.html.twig');
    }


    /**
     * Symfony gère entièrement cette route
     * @Route("/logout", name="logout")
     */
    public function logout() {}

}



