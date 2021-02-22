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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CampusController extends AbstractController
{


    /**
     * @Route("/campus", name="campus")
     */
    public function campus(EntityManagerInterface $em, Request $request): Response
    {

        $campus = new Campus();

        $campusForm = $this->createForm(CampusType::class, $campus);

        $campusForm->handleRequest($request);
        if ($campusForm->isSubmitted() && $campusForm->isValid()) {

            $em->persist($campus);
            $em->flush();



            return $this->render('campus/campus.html.twig', ['campus' => $campus]);


        }
        //$campus = $campusRepository->find($id);

        return $this->render('campus/campus.html.twig', [ 'campusForm' => $campusForm->createView()]);
    }

    /**
     * @param CampusRepository $campusRepository
     * @return Response
     * @Route("/campus/list", name="campus_list")
     */
public function listCampus (CampusRepository $campusRepository){
        $campus = $campusRepository -> findAll();



        return $this->render(' campus/campus_list.html.twig', [ ' campus' => $campus ]);

}

   /* public function modifierCampus()
    {
        if (!empty ($campus)) {
            $newCampus = $campus->getId();
            $campus->setName();
            $campus = $newCampus;


        }
    }*/
}


