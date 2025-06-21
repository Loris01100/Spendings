<?php

namespace App\Controller\Abonnement\Create;

use App\Entity\Abonnement;
use App\Form\Type\AbonnementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(
    path: '/abonnement/create',
    name: 'app_abonnement_create_get',
    methods: ['GET']
)]
#[IsGranted('ROLE_USER')] // ou 'ROLE_ADMIN' si tu veux restreindre
class AbonnementCreateGetController extends AbstractController
{
    public function __invoke(): Response
    {
        $form = $this->createForm(AbonnementType::class, new Abonnement());

        return $this->render('pages/abonnement/form.html.twig', [
            'form' => $form->createView(),
            'is_edit' => false,
        ]);
    }
}