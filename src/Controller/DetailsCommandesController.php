<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Commandes;
use App\Entity\CommandUsers;
use App\Entity\DetailsCommandes;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/details/commandes', name: 'app_details_commandes_')]
class DetailsCommandesController extends AbstractController
{
    #[Route('/ajout', name: 'Ajout')]
    public function add(SessionInterface $session, ArticlesRepository $articlesRepository, EntityManagerInterface $entityManagerInterface): Response
    {

        $this->denyAccessUnlessGranted('ROLE_USER');

        $panier = $session->get('panier', []);
        if ($panier === []) {
            $this->addFlash('message', 'votre panier est vide');
            return  $this->redirectToRoute('app_read');
        };
        // dan le cas ou le panier n'est pas vide, on cree la commande
        $commande = new Commandes();
        // $commande->setDateCreat(new \DateTime());
        $commandeUser = new CommandUsers();
        $commandeUser->setUsers($this->getUser());
        //on remplit la commande
        $commande->addCommandUser($commandeUser);
        $commande->setReference(uniqid());
        //parcours du panier


        foreach ($panier as $element => $quantiter) {
            $details = new DetailsCommandes();

            //on va chercher les Articles
            $articles = $articlesRepository->find($element);
            $prix = $articles->getPrixUnitaire();
            //creation du details commande
            $details->setArticles($articles);
            $details->setPrixTotal($prix);
            $details->setQuantites($quantiter);

            $commande->addDetailsCommande($details);
        }
        $commande->setDateCreat(new \DateTime());

        $entityManagerInterface->persist($commande);
        $entityManagerInterface->flush();
        return $this->render('details_commandes/index.html.twig', [
            'controller_name' => 'DetailsCommandesController',
        ]);
    }
}
