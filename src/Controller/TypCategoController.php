<?php

namespace App\Controller;

use App\Entity\Type;
use SebastianBergmann\CodeCoverage\Report\Html\Renderer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//#[Route('/typ/catego', name: 'app_typ_catego')]
class TypCategoController extends AbstractController
{
    #[Route('/{slugg}', name: 'app_typ_')]
    public function index(Type $type): Response
    {
        $article = $type->getArticles();
        return $this->render('typ_catego/listArticle.html.twig', compact('type', 'article'));
    }

    // #[Route('/{slug}', name: 'listArticle')]
    // public function listArticle(Type $type): Response
    // {
    //     //on va chercher la liste des articles
    //     $article = $type->getArticles();
    //     return $this->render('typ_catego/listArticle', compact('type', 'article'));
    // }
}
