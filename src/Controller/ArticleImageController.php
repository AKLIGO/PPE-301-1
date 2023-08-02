<?php

namespace App\Controller;

use App\Form\ArticleImageFormType;
use App\Entity\ArticleImage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticleImageRepository;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\Routing\Annotation\Route;

class ArticleImageController extends AbstractController
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    #[Route('/article/image', name: 'app_article_image')]
    public function index(): Response
    {
        return $this->render('article_image/index.html.twig', [
            'controller_name' => 'ArticleImageController',
        ]);
    }

    #[route('createImage', name: 'app_creatImage', methods: ['GET', 'POST'])]

    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $articleImage = new ArticleImage();
        $form = $this->createForm(ArticleImageFormType::class, $articleImage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $articleImage = $form->getData();
            $entityManager->persist($articleImage);
            $entityManager->flush();
            // return new Response('votre image est belle bien creer avec success
            // ');
            return $this->render('article_image/image_success.html.twig', ['articleImage' => $articleImage]);
            // Traitez les données du formulaire et persistez l'entité ArticleImage
            // ...
        }
        return $this->render('article_image/vue.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
