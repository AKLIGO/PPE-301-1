<?php

namespace App\Controller;

use App\Entity\Articles;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



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

    #[Route('/{slug}', name: 'details')]
    public function details(string $slug): Response
    {
        $entityManager = $this->managerRegistry->getManager();
        $article = $entityManager->getRepository(Articles::class)->findOneBy(['slug' => $slug]);

        if (!$article) {
            throw $this->createNotFoundException('Product not found');
        }

        return $this->render('article/details.html.twig', [
            'product' => $article,
        ]);
    }
}
