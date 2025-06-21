<?php

namespace App\Controller\Abonnement\Delete;
use App\Entity\Abonnement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/abonnement/delete/{id}',
    name: 'app_abonnement_delete_post',
    methods: [Request::METHOD_POST]
)]
class AbonnementDeletePostController extends AbstractController
{
    public function __invoke(Abonnement $abonnement, EntityManagerInterface $em): Response
    {
        $em->remove($abonnement);
        $em->flush();

        return $this->redirectToRoute('app_abonnement_list_get');
    }
}