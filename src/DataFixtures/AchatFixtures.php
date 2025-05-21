<?php

namespace App\DataFixtures;

use App\Entity\Achat;
use App\Entity\User;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AchatFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for($i = 1; $i <= 20; $i++){
            $post = new Achat();

            $utilisateur = $this->getReference('utilisateur_' . $faker->numberBetween(1, 5));
            $categorie = $this->getReference('categorie_' . $faker->numberBetween(1, 3));
            $post->setIdUtilisateur($faker->randomDigit());
            $post->setIdCategorie($faker->numberBetween(1, 5));
            $post->setMontant($faker->randomFloat(2, 10, 100));
            $post->setDateAchat(\DateTime::createFromFormat('d/m/Y', $faker->dateTimeBetween('-1 year', 'now')));
            $post->setDescription($faker->realText());

            $manager->persist($post);
        }


        $manager->flush();
    }
}
