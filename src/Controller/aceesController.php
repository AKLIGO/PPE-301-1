<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class aceesController extends AbstractController
{
    #[Route('/some-route', name: 'some_route')]
    public function someAction()
    {
        // Exemple de condition d'accès refusé
        if (!$this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('access-denied');
        }

        return $this->render('article/acces.html.twig');
    }
    #[Route('/access-denied-page', name: 'access_denied_page')]
    public function accessDeniedPageAction()
    {
        // Vous pouvez personnaliser cette action
        // par exemple, afficher une page d'accès refusé
        return $this->render('article/acces.html.twig');
    }
}
