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

class SortieController extends AbstractController
{

    /**
     * @Route("/creer_sortie", name="creer_sortie")
     */
    public function sortie(Request $request, EntityManagerInterface $em)
    {

        $sortie = new Sortie();
        $sortieForm = $this->createForm(EspaceAbonnesType::class, $sortie);

        $sortieForm->handleRequest($request);
        if ($sortieForm->isSubmitted() && $sortieForm->isValid())
        {
            $em->persist($sortie);
            $em->flush();

            return $this->redirectToRoute('espaceAbonnes');

        }

        return $this->render('sortie/formul_sortie.html.twig', ['sortieForm' => $sortieForm->createView()]);
    }


    /**
     * @Route("/afficher_sortie/{id}", name="afficher_sortie")
     */
    public function view($id, SortieRepository $sortieRepository): Response
    {
        $sortie = $sortieRepository->find($id);
        return $this->render('sortie/afficher.html.twig', ['sortie' => $sortie ]);
    }


}