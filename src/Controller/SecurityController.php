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
     * @Route("/connexion", name="login")
     */
    public function login(): Response

    {

        //Si on clique sur le bouton "submited"
        if(isset($_POST['submited'])){

        //On déclare nos variables qui arrivent du formulaire
            $username = $_POST['_username'];
            $password = $_POST['_password'];

            //rememberme
            //Si la case est cochée
            if($_POST['rememberme']) {
                //On set 2 cookies un pour l'utilisateur et un pour le mot de passe

                //le nom du cookie "remembermeu" la valeur "$username" et la durée "time() + 31536000"
                setcookie('remembermeu', $username, time() + 31536000);

                //le nom du cookie "remembermep" la valeur "$password" et la durée "time() + 31536000"
                setcookie('remembermep', $password, time() + 31536000);

            }
            //Si la case est décochée
            elseif(!$_POST['rememberme']) {

                //On cherche pour nos 2 cookies
                if (isset($_COOKIE['remembermeu'], $_COOKIE['remembermep'])) {
                    //Nous les plaçons comme si ils avaient expirés
                    $past = time() - 100;
                    setcookie(remembermeu, gone, $past);
                    setcookie(remembermep, gone, $past);
                }
            }
            //rememberme

        }

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

