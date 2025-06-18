<?php

namespace App\Controller\Achat\Delete;

use App\Entity\Achat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(
    path: '/achat/{id}/delete',
    name: 'app_achat_delete_post',
    requirements: ['id' => '\d+'],
    methods: ['POST']
)]
#[IsGranted('ROLE_ADMIN')]
class AchatDeletePostController extends AbstractController
{
    public function __invoke(
        Achat $achat,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response {

        if ($this->isCsrfTokenValid('delete_achat_' . $achat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($achat);
            $entityManager->flush();

            $this->addFlash('success', 'Achat supprimé avec succès.');
        }

        return $this->redirectToRoute('app_achat_list_get');
    }
}