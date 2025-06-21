<?php

namespace App\Controller\Test;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestSecurityController extends AbstractController
{
    #[Route('/test/security', name: 'app_test_security')]
    public function __invoke(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return new Response('❌ Aucun utilisateur connecté.');
        }

        $roles = $user->getRoles();
        $isAdmin = $this->isGranted('ROLE_ADMIN') ? '✅ OUI' : '❌ NON';

        return new Response(
            sprintf(
                "Utilisateur connecté : %s\nRôles : %s\nROLE_ADMIN ? %s",
                $user->getUserIdentifier(),
                implode(', ', $roles),
                $isAdmin
            ),
            200,
            ['Content-Type' => 'text/plain']
        );
    }
}