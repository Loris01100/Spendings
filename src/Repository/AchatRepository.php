<?php

namespace App\Repository;

use App\Entity\Achat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Achat>
 */
class AchatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Achat::class);
    }
    public function getAchats(?int $utilisateurId, ?int $categorieId): array
    {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.date_achat', 'DESC');

        if ($utilisateurId !== null) {
            $qb->andWhere('a.utilisateur = :utilisateurId')
                ->setParameter('utilisateurId', $utilisateurId);
        }

        if ($categorieId !== null) {
            $qb->andWhere('a.id_categorie = :categorieId')
                ->setParameter('categorieId', $categorieId);
        }

        return $qb->getQuery()->getResult();
    }


}
