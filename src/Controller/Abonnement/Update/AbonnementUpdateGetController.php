<?php

namespace App\Controller\Abonnement\Update;
use App\Entity\Abonnement;
use App\Form\Type\AbonnementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

#[Route(
    path: '/abonnement/update/{id}',
    name: 'app_abonnement_update_get',
    methods: ['GET']
)]
#[IsGranted('ROLE_USER')]
class AbonnementUpdateGetController extends AbstractController
{
    public function __invoke(Abonnement $abonnement): Response
    {
        $form = $this->createForm(AbonnementType::class, $abonnement);

        return $this->render('pages/abonnement/form.html.twig', [
            'form' => $form->createView(),
            'is_edit' => true,
        ]);
    }
}