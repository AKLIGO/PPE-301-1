<?php

namespace App\Controller;

use App\Entity\Type;
use App\Form\TypesFormType;

// use App\Entity\Articles;

//use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use function PHPSTORM_META\type;

// #[Route('/type', name: 'app_type_')]
class TypeController extends AbstractController
{

    private $managerRegistry;
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }


    #[Route('type', name: 'app_createType')]
    public function createType(Request $request, EntityManagerInterface $entityManager): Response
    {
        $type = new Type();
        $form = $this->createForm(TypesFormType::class,  $type);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $type = $form->getData();
            $entityManager->persist($type);
            $entityManager->flush();

            // return $this->redirectToRoute('')
            return new Response('votre type est belle bien creer avec success');
        };
        return $this->render('type/formulaireType.html.twig', [
            'form' => $form->createView(),
        ]);
    }




    // #[Route('/{slug}', name: 'list')]
    // public function list(string $slug): Response
    // {
    //     $entityManager = $this->managerRegistry->getManager();
    //     $type = $entityManager->getRepository(Type::class)->findOneBy(['slug' => $slug]);


    //     if (!$type) {
    //         throw $this->createNotFoundException('Type non trouvé');
    //     }

    //     $articles = $type->getArticles();
    //     dd($type);

    //     dd(count($type->getArticles()));

    //     return $this->render('type/list.html.twig', [
    //         'type' => $type,
    //         'articles' => $articles,
    //         dd($articles)
    //     ]);
    //}



    // #[Route('/{slug}', name: 'list')]
    // public function list(string $slug): Response
    // {
    // $entityManager = $this->managerRegistry->getManager();
    // $type = $entityManager->getRepository(Type::class)->findOneBy(['slug' => $slug]);

    // if (!$type) {
    // throw $this->createNotFoundException('Produit non trouvé');
    // }

    // //la liste des produits
    // $article = $type->getArticles();

    // return $this->render('type/list.html.twig', [
    // 'type' => $type,
    // 'art' => $article
    // ]);
    // }

    // #[Route('/{slug}', name: 'list')]
    // public function list(Type $type): Response
    // {
    //     $article = $type->getArticles();
    //     return $this->render('type/list.html.twig', [
    //         'type' => $type,
    //         'art' => $article
    //     ]);
    // }


    // #[Route('/{slug}', name: 'list')]
    // public function list(string $slug): Response
    // {
    //     $entityManager = $this->managerRegistry->getManager();
    //     $type = $entityManager->getRepository(Type::class)->findOneBy(['slug' => $slug]);



    //     if (!$type) {
    //         throw $this->createNotFoundException('Produit non trouvé');
    //     }

    //     //la liste des produits
    //     $articles = $type->getArticles();

    //     return $this->render('type/list.html.twig', [
    //         'type' => $type,
    //         'art' => $articles,

    //     ]);
    // }
}
