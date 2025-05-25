<?php

namespace App\DataFixtures;

use App\Entity\Abonnement;
use App\Entity\Categorie;
use App\Entity\User;
use App\Enum\Frequence;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AbonnementFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {$faker = Factory::create('fr_FR');

        $frequences = Frequence::cases();

        for ($i = 1; $i <= 10; $i++) {
            $abonnement = new Abonnement();

            // Relations
            $abonnement->setIdUtilisateur($this->getReference('utilisateur_' . ($i % 5 + 1), User::class));
            $abonnement->setIdCategorie($this->getReference('categorie_' . ($i % 5 +1), Categorie::class));

            // Données factices
            $abonnement->setLibelle($faker->words(3, true));
            $abonnement->setFrequence($faker->randomElement($frequences));
            $abonnement->setMontant($faker->randomFloat(2, 5, 50));

            $startDate = $faker->dateTimeBetween('-6 months', 'now');
            $endDate = (clone $startDate)->modify('+1 year');

            $abonnement->setDateDebut($startDate);
            $abonnement->setDateFin($endDate);
            $abonnement->setDescription($faker->optional()->realText(50));

            $manager->persist($abonnement);
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CategorieFixtures::class,
        ];
    }
}
