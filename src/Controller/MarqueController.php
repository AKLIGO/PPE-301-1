<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Form\MarqueFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/marque', name: 'app_marque')]
class MarqueController extends AbstractController
{
    #[Route('', name: 'indexApp_marque')]
    public function index(): Response
    {
        return $this->render('marque/index.html.twig', [
            'controller_name' => 'MarqueController',
        ]);
    }

    #[Route('createMarque', name: 'app_createMarque')]
    public function createMarque(Request $request, EntityManagerInterface $entityManager): Response
    {

        $marque = new Marque();
        $form = $this->createForm(MarqueFormType::class, $marque);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $marque = $form->getData();
            $entityManager->persist($marque);
            $entityManager->flush();

            // return $this->redirectToRoute('')
            return new Response('votre marque est belle bien creer avec success');
        };
        return $this->render('marque/formulaireMarque.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
