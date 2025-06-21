<?php

namespace App\Controller\Abonnement\Update;


use App\Entity\Abonnement;
use App\Form\Type\AbonnementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/abonnement/update/{id}',
    name: 'app_post_update_abonnement',
    methods: [Request::METHOD_POST]
)]
class AbonnementUpdatePostController extends AbstractController
{
    public function __invoke(Request $request, Abonnement $abonnement, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(AbonnementType::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
        }

        return $this->redirectToRoute('app_abonnement_list_get');
    }
}