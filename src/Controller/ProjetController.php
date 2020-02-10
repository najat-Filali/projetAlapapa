<?php

namespace App\Controller;

use App\Entity\Projet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProjetController extends AbstractController
{
    /**
     * @Route("/", name="projet")
     */
    public function index()
    {
        return $this->render('projet/index.html.twig', [
            'controller_name' => 'ProjetController',
        ]);
    }

    /**
     * @Route("/direction_artistique", name="direction_artistique", methods={"GET"})
     */
    public function directionArt(){
        $projetRepository = $this->getDoctrine()->getRepository(Projet::class);

        $projets =$projetRepository->findAll();

        return $this->render('projet/directionArtistique.html.twig', [
            'projets' => $projets,
        ]);
    }

    /**
     * @Route("/direction_projet", name="direction_projet", methods={"GET"})
     */
    public function directionProjet(){
        $projetRepository = $this->getDoctrine()->getRepository(Projet::class);

        $projets =$projetRepository->findAll();
        return $this->render('projet/directionProjet.html.twig', [
            'projets' => $projets,
        ]);
    }
}
