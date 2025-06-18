<?php

namespace App\Controller\Achat\Create;

use App\Entity\Achat;
use App\Form\Type\AchatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(
    path: '/achat/create',
    name: 'app_achat_create_post',
    methods: ['POST']
)]
#[IsGranted('ROLE_ADMIN')]
class AchatCreatePostController extends AbstractController
{
    public function __invoke(
        EntityManagerInterface $entityManager,
        Request $request
    ): Response {
        $achat = new Achat();
        $form = $this->createForm(AchatType::class, $achat);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($achat);
            $entityManager->flush();

            return $this->redirectToRoute('app_achat_list_get');
        }

        return $this->render('pages/achat/form.html.twig', [
            'page_title' => 'Nouvel Achat',
            'form' => $form->createView(),
        ]);
    }
}