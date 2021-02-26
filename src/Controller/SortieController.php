<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Entity\Ville;
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
        $sortie->setEtat('Créée');
        $sortieForm = $this->createForm(EspaceAbonnesType::class, $sortie);

        $sortieForm->handleRequest($request);
        if ($sortieForm->isSubmitted() && $sortieForm->isValid())
        {
            $em->persist($sortie);
            $em->flush();

            $this->addFlash("success", "Ajout réussi");
            return $this->redirectToRoute('listSorties');
        }

        $campusRepo = $this->getDoctrine()->getRepository(Campus::class);
        $campusList= $campusRepo->findAll();

        $villeRepo = $this->getDoctrine()->getRepository(Ville::class);
        $villeList= $villeRepo->findAll();

        $lieuRepo = $this->getDoctrine()->getRepository(Lieu::class);
        $lieuList= $lieuRepo->findAll();

        return $this->render('sortie/formul_sortie.html.twig',
                    ['sortieForm' => $sortieForm->createView(),
                    'villeList'=> $villeList,
                    'campusList'=> $campusList,
                    'lieuList'=> $lieuList]);
    }


    /**
     * @Route("/sortie/afficher/{id}", name="afficher_sortie")
     */
    public function view($id, SortieRepository $sortieRepository): Response
    {

        $participants = $sortieRepository->find($id);

        $sortie = $sortieRepository->find($id);
        return $this->render('sortie/afficher.html.twig', ['sortie' => $sortie, 'participants'=> $participants ]);
    }




    /**
     * @Route("/sortie/modifier/{id}", name="sortie_update")
     */
    public function modifierSortie($id, Request $request, EntityManagerInterface $em, SortieRepository $repository)
    {
        //@todo: récupérer l'id de la sortie
        $sortie = $repository->find($id);

        //@todo: modifier une sortie
        $sortieForm = $this->createForm(EspaceAbonnesType::class, $sortie);
        $sortieForm->handleRequest($request);

        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {
            $em->persist($sortie);
            $em->flush();

            $this->addFlash("success", "Modification réussie");
            return $this->redirectToRoute('listSorties');
        }

        return $this->render('sortie/modifier.html.twig',['sortieForm' => $sortieForm->createView(), 'sortie' => $sortie]);

    }



    /**
     * @Route("/sortie/delete/{id}", name="sortie_delete", requirements={"id": "\d+"})
     */
    public function sortieSupprimer($id, EntityManagerInterface $em, SortieRepository $repository):Response
    {

        //@todo: récupérer l'id de la sortie
        $sortie = $repository->find($id);

        //@todo: annuler une sortie

        $em->remove($sortie);
        $em->flush();

        $this->addFlash('success', "La sortie a bien été annulée !");

        return $this->redirectToRoute('listSorties');

    }

}