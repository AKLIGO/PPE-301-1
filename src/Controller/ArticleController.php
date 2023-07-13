<?php

namespace App\Controller;

use App\Entity\Articles;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticlesRepository;
use App\Controller\Type;

use App\Form\ArticleFormType;




#[Route('/Article', name: 'app_Article')]
class ArticleController extends AbstractController
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('article/index.html.twig');
    }


    #[route('create', name: 'app_creat')]

    public function create(Request $request, ArticlesRepository $articlesRepository)
    {

        //$entityManager = $this->getDoctrine()->getManager();
        //creer un objet article
        $article = new Articles();

        //on recupere notre formulaire
        $form = $this->createForm(ArticleFormType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articlesRepository->save($article, true);

            return $this->redirectToRoute("app_read");
        }
        $formView = $form->createView();
        return $this->render('article/vue.html.twig', array(
            'form' => $formView
        ));
    }



    #[Route('lire', name: "app_read")]
    public function lire(ArticlesRepository $articlesRepository)
    {
        $listes = $articlesRepository->findAll();
        return $this->render('article/listes.html.twig', [
            'article' => $listes,
        ]);
    }

    // #[Route('/{slug}', name: 'details')]
    // public function details(string $slug): Response
    // {
    //     $entityManager = $this->managerRegistry->getManager();
    //     $article = $entityManager->getRepository(Articles::class)->findOneBy(['slug' => $slug]);

    //     if (!$article) {
    //         throw $this->createNotFoundException('Product not found');
    //     }

    //     return $this->render('article/details.html.twig', [
    //         'product' => $article,
    //     ]);
    // }
}
