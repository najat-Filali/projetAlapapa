<?php

namespace App\Controller;

use App\Entity\Article;
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
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
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
     * @Route("/article/{id}", name="article_view", methods={"GET", "HEAD"}, requirements={
     * "id"="\d+"})
     */
    public function articleView($id){
        $article = $this->getDoctrine()->getrepository(Article::class)->find($id); 
        
        if(is_null($article)){

            throw $this->createNotFoundException('Article Not Found'); 
        }

        return $this->render('article/view.html.twig', [
            'article' => $article,
        ]);      
    }


    
}
