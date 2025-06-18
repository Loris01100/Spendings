<?php

namespace App\Controller\Achat\Show;

use App\Entity\Achat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(
    path: '/achat/{id}',
    name: 'app_achat_show_get',
    requirements: ['id' => '\d+'],
    methods: ['GET']
)]
#[IsGranted('ROLE_USER')]
class AchatShowGetController extends AbstractController
{
    public function __invoke(Achat $achat): Response
    {
        return $this->render('pages/achat/show.html.twig', [
            'achat' => $achat,
        ]);
    }
}