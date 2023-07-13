<?php

namespace App\Controller;

use App\Entity\Type;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//#[Route('/type', name: 'app_type_')]
class essypeController extends AbstractController
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    #[Route('/{slug}', name: 'list')]
    public function list(string $slug): Response
    {
        $entityManager = $this->managerRegistry->getManager();
        $type = $entityManager->getRepository(Type::class)->findOneBy(['slug' => $slug]);

        if (!$type) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        //la liste des produits
        $article = $type->getArticles();

        return $this->render('type/list.html.twig', compact('type', 'article'));

        // return $this->render('type/list.html.twig', [
        //     'type' => $type,
        //     'art' => $article
        // ]);
    }
}
