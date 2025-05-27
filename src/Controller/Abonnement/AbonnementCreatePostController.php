<?php

namespace App\Controller\Abonnement;
use App\Entity\Abonnement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/abonnement/create',
    name: 'app_post_create_abonnement',
    methods: [Request::METHOD_POST]
)]
class AbonnementCreatePostController extends AbstractController
{
    public function __invoke(Request $request, EntityManagerInterface $em): Response
    {
        $abonnement = new Abonnement();
        $form = $this->createForm(Abonnement::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($abonnement);
            $em->flush();
        }

        return $this->redirectToRoute('app_get_list_abonnement');
    }
}