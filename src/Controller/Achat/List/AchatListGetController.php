<?php

namespace App\Controller\Achat\List;

use App\Entity\Achat;
use App\Form\Type\AchatType;
use App\Repository\AchatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(
    path: '/achat',
    name: 'app_achat_list_get',
    methods: ['GET']
)]
#[IsGranted('ROLE_USER')]
class AchatListGetController extends AbstractController
{
    public function __invoke(
        AchatRepository $achatRepository,
        #[MapQueryParameter]
        ?int $categorie_id = null
    ): Response {
        $user = $this->getUser(); // utilisateur connecté
        $achats = $achatRepository->getAchats($user->getId(), $categorie_id);

        $achat = new Achat(); // formulaire vierge
        $form = $this->createForm(AchatType::class, $achat, [
            'action' => $this->generateUrl('app_achat_create_post'),
            'method' => 'POST',
        ]);

        // Calculer le montant total dépensé
        $montantTotal = 0;
        foreach ($achats as $achat) {
            $montantTotal += $achat->getMontant();
        }

        return $this->render('pages/achat/list.html.twig', [
            'achats' => $achats,
            'formAchat' => $form->createView(),
            'categorie_id' => $categorie_id,
            'montantTotal' => $montantTotal,
        ]);

    }
}
