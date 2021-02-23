<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Participant;
use App\Form\CampusType;
use App\Form\InscriptionType;
use App\Repository\CampusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/"), name="home")
     */
    public function home()
    {
        return $this->render('user/home.html.twig');
    }


    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $participant = new Participant();
        $participant->setAdministrateur(true);
        $participant->setActif(true);
        $inscriptionForm = $this->createForm(InscriptionType::class, $participant);

        $inscriptionForm->handleRequest($request);
        if ($inscriptionForm->isSubmitted() && $inscriptionForm->isValid())
        {
            $password = $inscriptionForm->get('motDePasse')->getData();
            $participant->setMotDePasse($encoder->encodePassword($participant, $password));

            $em->persist($participant);
            $em->flush();


            return $this->redirectToRoute('app_user_home', ['id' => $participant->getId()]);
        }

        return $this->render('user/inscription.html.twig', ['inscriptionForm' => $inscriptionForm->createView()]);
    }

    /**
    * @Route("/profil", name="profil")
    */
    public function description(): Response

    {
        return $this->render('user/Profil.html.twig');
    }

    /**
     * @Route("/espaceAbonnes", name="espaceAbonnes")
     */
    public function abonnes(): Response
    {

        $campusRepo = $this->getDoctrine()->getRepository(Campus::class);
        $campusList= $campusRepo->findAll();

        return $this->render('user/espaceAbonnes.html.twig', ['campusList' => $campusList]);
    }





}

