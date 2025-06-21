<?php

namespace App\Controller\Abonnement\List;

use App\Repository\AbonnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(
    path: '/abonnement',
    name: 'app_abonnement_list_get',
    methods: ['GET']
)]
#[IsGranted('ROLE_USER')]
class AbonnementListGetController extends AbstractController
{
    public function __invoke(AbonnementRepository $repo): Response
    {
        return $this->render('pages/abonnement/list.html.twig', [
            'abonnements' => $repo->findBy(['id_utilisateur' => $this->getUser()]),
        ]);
    }
}
