<?php

namespace App\DataFixtures;

use App\Entity\Achat;
use App\Entity\User;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AchatFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 10; $i++) {
            $achat = new Achat();

            $achat->setIdUtilisateur($this->getReference('utilisateur_' . ($i % 5 + 1), User::class));
            $achat->setIdCategorie($this->getReference('categorie_' . ($i % 5 + 1), Categorie::class));
            $achat->setMontant($faker->randomFloat(2, 10, 100));
            $achat->setDateAchat($faker->dateTimeBetween('-1 year', 'now'));
            $achat->setDescription($faker->realText(50));

            $manager->persist($achat);
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
