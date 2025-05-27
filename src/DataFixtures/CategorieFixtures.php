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
            $categorie = new Categorie();
            $categorie->setNom($faker->word());
            $manager->persist($categorie);

            $this->addReference('categorie_' . $i, $categorie);
        }

        $manager->flush();
    }
}

