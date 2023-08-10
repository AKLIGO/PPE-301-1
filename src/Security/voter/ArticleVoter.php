<?php

namespace App\Security\voter;

use App\Entity\Articles;
use Doctrine\Common\Lexer\Token;
use PhpParser\Node\Stmt\Break_;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Componnent\Security\Core\Security;

class ProductVoter extends Voter
{
    const EDIT = 'PRODUCT_EDIT';
    const DELETE = 'PRODUCT_DELETE';
    private $security;

    protected function __construct(Security $security)
    {
        $this->security = $security;
    }


    protected function supports(string $attribute, $article): bool
    {
        if (!in_array($attribute, [self::EDIT, self::DELETE])) {
            return false;
        }

        if (!$article instanceof Articles) {
            return false;
        }
        return true;
        // return in_array()
    }

    protected function voteOnAttribute($attribute, $article, TokenInterface $token): bool
    {
        //recupere l'utilisateur a partir du token
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }

        // On verifie si l'utilisateur est admin

        if ($this->security->isGranted('ROLE_ADMIN')) return true;
        //on verifie les permissions
        switch ($attribute) {
            case self::EDIT:

                return $this->canEdit();

                //on verifie si l'utilisateur peut editer
                break;

            case self::DELETE:
                //on verifie si l'utilisateur peut supprimer

                return $this->canDelete();
                break;
        }
    }

    private function canEdit()
    {
        return $this->security->isGranted('ROLE_ARTICLE');
    }

    private function canDelete()
    {
        return $this->security->isGranted('ROLE_ARTICLE');
    }
}
