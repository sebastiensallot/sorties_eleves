<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Sortie;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EspaceAbonnesController extends AbstractController

{
    /**
     * @Route ("/espaceAbonnes", name= "listSorties")
     */
    public function sortiesAbonnes()
    {
        $campusRepo = $this->getDoctrine()->getRepository(Campus::class);
        $campusList= $campusRepo->findAll();

        $villeRepo= $this-> getDoctrine()->getRepository(Sortie::class);
        $sortieList= $villeRepo->findAll();

        return $this-> render('user/espaceAbonnes.html.twig', ['sortieList'=> $sortieList, 'campusList' => $campusList]);
    }



}