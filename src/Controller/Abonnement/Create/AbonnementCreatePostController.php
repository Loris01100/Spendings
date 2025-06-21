<?php

namespace App\Controller\Abonnement\Create;
use App\Entity\Abonnement;
use App\Form\Type\AbonnementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/abonnement/create',
    name: 'app_abonnement_create_post',
    methods: [Request::METHOD_POST]
)]
class AbonnementCreatePostController extends AbstractController
{
    public function __invoke(Request $request, EntityManagerInterface $em): Response
    {
        $abonnement = new Abonnement();
        $form = $this->createForm(AbonnementType::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $abonnement->setIdUtilisateur($this->getUser());

            $em->persist($abonnement);
            $em->flush();

            $this->addFlash('success', 'Abonnement ajouté avec succès.');
        }

        return $this->redirectToRoute('app_abonnement_list_get');
    }
}