<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Exemple dans UtilisateurFixtures.php
        $faker = Factory::create('fr_FR');
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->setEmail($faker->name());
            $user->
            // autres setters...
            $manager->persist($user);

            $this->addReference('utilisateur_' . $i, $user);
        }


        $manager->flush();
    }
}
