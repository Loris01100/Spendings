<?php

namespace App\Controller\Achat\Update;

use App\Entity\Achat;
use App\Form\Type\AchatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(
    path: '/achat/{id}/edit',
    name: 'app_achat_update_post',
    requirements: ['id' => '\d+'],
    methods: ['POST']
)]
#[IsGranted('ROLE_ADMIN')]
class AchatUpdatePostController extends AbstractController
{
    public function __invoke(
        Achat $achat,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Achat modifié avec succès.');
            return $this->redirectToRoute('app_achat_list_get');
        }

        return $this->render('pages/achat/form.html.twig', [
            'page_title' => 'Modifier un achat',
            'form' => $form->createView(),
        ]);
    }
}