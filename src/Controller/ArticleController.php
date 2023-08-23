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
use Doctrine\ORM\EntityManagerInterface;
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

    public function create(Request $request, ArticlesRepository $articlesRepository, EntityManagerInterface $entityManager)
    {

        //$entityManager = $this->getDoctrine()->getManager();
        //creer un objet article
        $article = new Articles();

        //on recupere notre formulaire
        $form = $this->createForm(ArticleFormType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $articlesRepository->save($article, true);
            $article = $form->getData();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('app_creatImage');
        }
        $formView = $form->createView();
        return $this->render('article/vue.html.twig', array(
            'form' => $form->createView(),
            'article' => $article,

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



    // #[Route('/delete/{id}', name: 'app_delete')]
    // public function delete(int $id, ArticlesRepository $articlesRepository, EntityManagerInterface $entityManager)
    // {
    //     // Charger l'entité Articles à partir de l'ID
    //     $article = $articlesRepository->find($id);

    //     if (!$article) {
    //         throw $this->createNotFoundException('Article not found.');
    //     }

    //     // Supprimer l'article de la base de données
    //     $entityManager->remove($article);
    //     $entityManager->flush();

    //     // Rediriger vers la liste des articles après la suppression
    //     return $this->redirectToRoute('app_read');
    // }

    #[Route('/voir/{id}', name: 'app_view')]
    public function voir(int $id, ArticlesRepository $articlesRepository,  EntityManagerInterface $entityManager)
    {
        $article = $articlesRepository->find($id);
        if (!$article) {
            throw $this->createNotFoundException('Article not found.');
        }

        return $this->render('article/view.html.twig', [
            'VoirArticle' => $article
        ]);
    }

    #[Route('/acces', name: 'acces-refuser')]
    public function acces(): Response
    {
        return $this->render('article/acces.html.twig');
    }




    // #[Route('/delete{id}', name: 'app_delete')]
    // public function delete(Articles $articles, ArticlesRepository $articlesRepository)
    // {
    //     $articlesRepository->remove($articles, true);
    //     return $this->redirectToRoute('app_read');
    // }

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
