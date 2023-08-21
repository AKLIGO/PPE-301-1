<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/panier', name: 'panier_')]
class PanierController extends AbstractController
{





    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ArticlesRepository $articlesRepository, Articles $articles)
    {

        $panier = $session->get('panier', []);


        //on initialise des variables
        $data = [];
        $total = 0;




        foreach ($panier as $id => $quantiter) {
            // dd($panier);
            $articles = $articlesRepository->findOneBy(["id" => $id]);
            $data[] = [
                'articles' => $articles,
                'quantiter' => $quantiter
            ];


            // dd($articles);
            $total += $articles->getPrixUnitaire() * $quantiter;
        }
        return $this->render("panier/index.html.twig", [
            'data' => $data,
            'total' => $total
        ]);



        // dd($data);
    }
    #[Route('addArticle/{id}', name: 'addArticle')]
    public function addP($id, SessionInterface $session)

    {
        //recuperer id du produit
        // $id = $articles->getId();
        //recuperer le panier existant
        $panier = $session->get('panier', []);

        //on ajoute l'article dans la session


        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        // dd($panier);
        $session->set('panier', $panier);
        // dd($session);

        return $this->redirectToRoute('panier_index');
    }


    #[Route('remove/{id}', name: 'remove')]
    public function remove($id, SessionInterface $session)

    {
        //recuperer id du produit
        // $id = $articles->getId();
        //recuperer le panier existant
        $panier = $session->get('panier', []);

        //on ajoute l'article dans le panier s'il n'y a qu'un exemplaire

        // sinon on decremente sa quantiter
        if (!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }

        // dd($panier);
        $session->set('panier', $panier);
        // dd($session);

        return $this->redirectToRoute('panier_index');
    }

    #[Route('/empty', name: 'empty')]
    public function empty(SessionInterface $session)
    {
        $session->remove('panier');
        return $this->redirectToRoute('panier_index');
    }
}
