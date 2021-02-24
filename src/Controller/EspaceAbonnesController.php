<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\EspaceAbonnesType;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EspaceAbonnesController extends AbstractController

{
    /**
     * @Route ("/espaceAbonnes", name= "listSorties")
     */
    public function sorties (Request $request, EntityManagerInterface $em)
    {

        $villeRepo= $this-> getDoctrine()-> getRepository(Sortie::class);
        $sortieList= $villeRepo->findAll();

        return $this-> render('user/espaceAbonnes.html.twig', ['sortieList'=> $sortieList]);
    }



}