<?php

namespace App\Controller\Achat\List;
use App\Repository\AchatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(
    path: '/achats',
    name: 'app_achat_list_get',
    methods: ['GET']
)]
#[IsGranted('ROLE_USER')]
class AchatListGetController extends AbstractController
{
    public function __invoke(
        AchatRepository $achatRepository,
        #[MapQueryParameter]
        ?int $utilisateur_id = null,
        #[MapQueryParameter]
        ?int $categorie_id = null
    ): Response {
        $achats = $achatRepository->getAchats($utilisateur_id, $categorie_id);

        return $this->render('pages/achat/list.html.twig', [
            'achats' => $achats,
            'utilisateur_id' => $utilisateur_id,
            'categorie_id' => $categorie_id,
        ]);
    }
}