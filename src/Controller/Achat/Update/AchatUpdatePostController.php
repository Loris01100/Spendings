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
    path: '/achat/{id}/update',
    name: 'app_achat_update_post',
    requirements: ['id' => '\d+'],
    methods: ['POST']
)]
#[IsGranted('ROLE_USER')]
class AchatUpdatePostController extends AbstractController
{
    public function __invoke(
        Achat $achat,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response {
        if ($achat->getUtilisateur() !== $this->getUser() && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Accès interdit');
        }

        $form = $this->createForm(AchatType::class, $achat, [
            'is_edit' => true,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Achat modifié avec succès.');
            return $this->redirectToRoute('app_achat_list_get');
        }

        return $this->render('pages/achat/form.html.twig', [
            'form' => $form->createView(),
            'achatToEdit' => true,
        ]);
    }
}