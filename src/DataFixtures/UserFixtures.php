<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public const ADMIN_USER_REFERENCE = 'admin-user';
    public const USER_REFERENCE = 'user';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        //admin
        $userAdmin = new User();
        $userAdmin->setEmail('admin@example.com');
        $userAdmin->setPassword('adminpassword');
        $userAdmin->setArgent($faker->randomFloat(2, 500, 1000));
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $manager->persist($userAdmin);
        $this->addReference(self::ADMIN_USER_REFERENCE, $userAdmin);

        //users
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->setEmail($faker->unique()->safeEmail());
            $user->setPassword('password');
            $user->setArgent($faker->randomFloat(2, 10, 500));
            $user->setRoles(['ROLE_USER']);

            $manager->persist($user);
            $this->addReference('utilisateur_' . $i, $user);
        }

        $manager->flush();
    }

}
