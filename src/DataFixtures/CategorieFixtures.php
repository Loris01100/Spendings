<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 1; $i <= 5; $i++) {
            $user = new Categorie();
            $user->setNom($faker->name());
            $manager->persist($user);

            $this->addReference('utilisateur_' . $i, $user);
        }

        $manager->flush();
    }
}
