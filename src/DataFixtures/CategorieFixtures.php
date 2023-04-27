<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoriesFixtures extends Fixture
{
    private const NB_CATEGORIES = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::NB_CATEGORIES; $i++) {
            $categorie = new Categorie();
            $categorie
                ->setName($faker->word());

            $manager->persist($categorie);
            $this->addReference('categories', $categorie);
        }

        $manager->flush();
    }
}

