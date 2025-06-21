<?php

namespace App\Controller\Achat\Create;

use App\Entity\Achat;
use App\Form\Type\AchatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(
    path: '/achat/create',
    name: 'app_achat_create_get',
    methods: ['GET']
)]
#[IsGranted('ROLE_ADMIN')]
class AchatCreateGetController extends AbstractController
{
    public function __invoke(): Response
    {
        $form = $this->createForm(
            type: AchatType::class,
        );

        return $this->render('pages/achat/form.html.twig', [
            'page_title' => 'Nouvel Achat',
            'form' => $form->createView(),
            'is_edit' => false,
        ]);
    }
}