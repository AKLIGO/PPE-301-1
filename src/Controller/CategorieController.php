<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie', name: 'app_categorie')]
class CategorieController extends AbstractController
{
    #[Route('', name: 'app_indexCategorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }


    #[Route('createCategorie', name: 'app_createCategorie')]
    public function createCategorie(Request $request, EntityManagerInterface $entityManager): Response
    {

        $categorie = new Categorie();
        $form = $this->createForm(CategorieFormType::class, $categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $categorie = $form->getData();
            $entityManager->persist($categorie);
            $entityManager->flush();

            // return $this->redirectToRoute('')
            return new Response('votre categorie est belle bien creer avec success');
        };
        return $this->render('categorie/formulaireType.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
