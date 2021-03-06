<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Projet;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $projetRepository = $this->getDoctrine()->getRepository(Projet::class);
        
        //last article order by date
        $article = $articleRepository->findBy([], ['date' => "DESC"], 1);

        //3 most important projects 
        $projets = $projetRepository->findBy([], ['id' => "DESC"], 3);
             
        return $this->render('article/index.html.twig', [
            'article' => $article[0],
            'projets' => $projets 
        ]);
    }
  
    /**
     * @Route("/article", name="article", methods={"GET"})
     */
    public function articles(){

        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $articles =$articleRepository->findAll();

        return $this->render('article/article.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_view", methods={"GET"}, requirements={
     * "id"="\d+"})
     */
    public function articleView($id){

        $articleRepository = $this->getDoctrine()->getrepository(Article::class); 
        $article =$articleRepository->find($id);

        if(is_null($article)){
            throw $this->createNotFoundException('Article non trouvé'); 
        }
        return $this->render('article/view.html.twig', [
            'article' => $article,
        ]);      
    } 
}
