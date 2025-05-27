<?php

namespace App\Controller\Abonnement;

use App\Entity\Abonnement;
use App\Repository\AbonnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route(
    path: '/abonnement',
    name: 'app_get_list_abonnement',
    methods: [Request::METHOD_GET]
)]
class AbonnementListGetController extends AbstractController
{
    public function __invoke(AbonnementRepository $repo): Response
    {
        return $this->render('templates/abonnement/index.html.twig', [
            'abonnements' => $repo->findAll(),
            'form' => $this->createForm(Abonnement::class)->createView(),
        ]);
    }
}