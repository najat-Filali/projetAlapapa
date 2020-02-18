<?php

namespace App\Controller;

use App\Entity\Categorie;
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
        $projetRepository = $this->getDoctrine()->getrepository(Projet::class); 
        $projet =$projetRepository->findBy(['id']); 
        return $this->render('projet/index.html.twig', [
            'projet'=> $projet, 
        ]);
    }
   
    /**
     * @Route("/direction_artistique", name="direction_artistique", methods={"GET"})
     */
    public function directionArt(){
        $projetRepository = $this->getDoctrine()->getRepository(Projet::class);
        $cat = $this->getDoctrine()->getRepository(Categorie::class)->findOneBy(['nom' => 'artistique']);

        $projets =$projetRepository->findBy(['categorie'=>$cat], [], 3 );

        return $this->render('projet/directionArtistique.html.twig', [
            'projets' => $projets,
        ]);
    }

    /**
     * @Route("/direction_projet", name="direction_projet", methods={"GET"})
     */
    public function directionProjet(){
        $projetRepository = $this->getDoctrine()->getRepository(Projet::class);
        $cat = $this->getDoctrine()->getRepository(Categorie::class)->findOneBy(['nom' => 'projet']);

        $projets =$projetRepository->findBy(['categorie'=>$cat], [], 3);

        return $this->render('projet/directionProjet.html.twig', [
            'projets' => $projets,
        ]);
    }
}
