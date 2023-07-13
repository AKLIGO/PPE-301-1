<?php

namespace App\Controller;

use App\Repository\TypeRepository;
use App\Controller\CategorieRepository;
use App\Repository\CategorieRepository as RepositoryCategorieRepository;
use Doctrine\DBAL\Types\TypeRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(TypeRepository $typeRepository, RepositoryCategorieRepository $categorieRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'types' => $typeRepository->findBy([]),
            'categorie' => $categorieRepository->findBy([])


        ]);
    }
}
