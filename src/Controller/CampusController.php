<?php

namespace App\Controller;

use App\Entity\Campus;

use App\Form\CampusType;

use App\Repository\CampusRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class CampusController extends AbstractController
{

    /**
     * @Route("/campus/list", name="campus_list")
     */
    public function listCampus()
    {
        //@todo: accès seulement pour administrateur

        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        if(!$this->isGranted("ROLE_ADMIN"))
        {
            throw  new AccessDeniedException("Accès refusé");
        }

        //@todo: liste des campus

        $campusRepo = $this->getDoctrine()->getRepository(Campus::class);
        $campusList= $campusRepo->findAll();

        return $this->render('campus/campusList.html.twig', [ 'campusList' => $campusList ]);

    }





    /**
     * @Route("/campus/add", name="campus_add")
     */
    public function campusAjouter(EntityManagerInterface $em, Request $request): Response
    {
        //@todo: accès seulement pour administrateur

        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        if(!$this->isGranted("ROLE_ADMIN"))
        {
            throw new AccessDeniedException("Accès refusé");
        }

        //@todo: créer un campus

        $campus = new Campus();
        $campusForm = $this->createForm(CampusType::class, $campus);

        $campusForm->handleRequest($request);
        if ($campusForm->isSubmitted() && $campusForm->isValid())
        {
            $em->persist($campus);
            $em->flush();

            $this->addFlash("success", "Ajout réussi");

            return $this->redirectToRoute('campus_list');
        }

        return $this->render('campus/campusAjouter.html.twig', [ 'campusForm' => $campusForm->createView()]);
    }




    /**
     * @Route("/campus/update/{id}", name="campus_update", requirements={"id": "\d+"})
     */
    public function campusModifier($id, Request $request, EntityManagerInterface $entityManager, CampusRepository $repository)
    {

        //@todo: accès seulement pour administrateur

        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        if(!$this->isGranted("ROLE_ADMIN"))
        {
            throw new AccessDeniedException("Accès refusé");
        }

        //@todo: modifier un campus

        $campus = $repository->find($id);
        $campusForm= $this->createForm(CampusType::class, $campus);
        $campusForm->handleRequest($request);
        if($campusForm->isSubmitted() && $campusForm->isValid())
        {
            $entityManager->persist($campus);
            $entityManager->flush();
            $this->addFlash("success", "Modification réussie");

            return $this->redirectToRoute('campus_list');
        }
        return $this->render('campus/campusModifier.html.twig', ['campusForm'=> $campusForm->createView()]);


    }




    /**
     * @Route("/campus/delete/{id}", name="campus_delete", requirements={"id": "\d+"}, methods={"GET"})
     */
    public function campusSupprimer($id, EntityManagerInterface $entityManager, CampusRepository $repository):Response
    {
        //@todo: accès seulement pour administrateur

        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        if(!$this->isGranted("ROLE_ADMIN"))
        {
            throw new AccessDeniedException("Accès refusé");
        }

        //@todo: récupérer l'id du campus
        $campus = $repository->find($id);

        //@todo: supprimer un campus

        $entityManager->remove($campus);
        $entityManager->flush();

        $this->addFlash('success', "Le campus a bien été supprimé !");
        return $this->redirectToRoute('campus_list');

    }

}


