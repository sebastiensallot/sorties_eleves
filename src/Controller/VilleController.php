<?php

namespace App\Controller;

use App\Entity\Ville;


use App\Form\VilleType;
use App\Repository\VilleRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class VilleController extends AbstractController
{

    /**
     * @Route("/ville/list", name="ville_list")
     */
    public function listVilles()
    {
        //@todo: accès seulement pour administrateur

        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        if(!$this->isGranted("ROLE_ADMIN"))
        {
            throw  new AccessDeniedException("Vous n'avez pas le droit");
        }

        //@todo: liste des villes

        $villeRepo = $this->getDoctrine()->getRepository(Ville::class);
        $villeList= $villeRepo->findAll();

        return $this->render('ville/villeList.html.twig', [ 'villeList' => $villeList ]);

    }


    /**
     * @Route("/ville/add", name="ville_add")
     */
    public function villeAjouter(EntityManagerInterface $em, Request $request): Response
    {
        //@todo: accès seulement pour administrateur

        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        if(!$this->isGranted("ROLE_ADMIN"))
        {
            throw new AccessDeniedException("Accès refusé");
        }

        //@todo: créer un campus

        $ville = new Ville();
        $villeForm = $this->createForm(VilleType::class, $ville);

        $villeForm->handleRequest($request);
        if ($villeForm->isSubmitted() && $villeForm->isValid())
        {
            $em->persist($ville);
            $em->flush();

            $this->addFlash("success", "Ajout réussi");
            return $this->redirectToRoute('ville_list');
        }

        return $this->render('ville/villeAjouter.html.twig', [ 'villeForm' => $villeForm->createView()]);
    }



    /**
     * @Route("/ville/update/{id}", name="ville_update", requirements={"id": "\d+"})
     */
    public function villeModifier($id, Request $request, EntityManagerInterface $entityManager, VilleRepository $repository)
    {

        //@todo: accès seulement pour administrateur

        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        if(!$this->isGranted("ROLE_ADMIN"))
        {
            throw new AccessDeniedException("Accès refusé");
        }

        //@todo: modifier une ville

        $ville = $repository->find($id);
        $villeForm= $this->createForm(VilleType::class, $ville);
        $villeForm->handleRequest($request);
        if($villeForm->isSubmitted() && $villeForm->isValid())
        {
            $entityManager->persist($ville);
            $entityManager->flush();
            $this->addFlash("success", "Modification réussie");

            return $this->redirectToRoute('ville_list');
        }
        return $this->render('ville/villeModifier.html.twig', ['villeForm'=> $villeForm->createView()]);


    }



    /**
     * @Route("/ville/delete/{id}", name="ville_delete", requirements={"id": "\d+"},methods={"GET"})
     */
    public function villeSupprimer($id, EntityManagerInterface $entityManager, VilleRepository $repository):Response
    {
        //@todo: accès seulement pour administrateur

        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        if(!$this->isGranted("ROLE_ADMIN"))
        {
            throw new AccessDeniedException("Accès refusé");
        }

        //@todo: récupérer l'id de la ville
        $ville = $repository->find($id);

        //@todo: supprimer une ville

        $entityManager->remove($ville);
        $entityManager->flush();

        $this->addFlash('success', "La ville a bien été supprimé !");

        return $this->redirectToRoute('ville_list');

    }

}
