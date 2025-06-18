<?php

namespace App\Controller\Achat\Update;

use App\Entity\Achat;
use App\Form\Type\AchatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(
    path: '/achat/{id}/edit',
    name: 'app_achat_update_get',
    requirements: ['id' => '\d+'],
    methods: ['GET']
)]
#[IsGranted('ROLE_ADMIN')]
class AchatUpdateGetController extends AbstractController
{
    public function __invoke(Achat $achat): Response
    {
        $form = $this->createForm(AchatType::class, $achat);

        return $this->render('pages/achat/form.html.twig', [
            'page_title' => 'Modifier un achat',
            'form' => $form->createView(),
        ]);
    }
}