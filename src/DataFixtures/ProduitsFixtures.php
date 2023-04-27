<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProduitsFixtures extends Fixture implements DependentFixtureInterface
{
    private const NB_PRODUITS = 50;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $categories = $this->getReference('categories');

        for ($i = 0; $i < self::NB_PRODUITS; $i++) {
            $produit = new Produit();
            $produit
                ->setNom($faker->realText(35))
                ->setVisible($faker->boolean(80))
                ->setDiscount($faker->randomElement([true, false, false]))
                ->setPrixHT($faker->randomFloat(2, 10, 500))
                ->setDescription($faker->realTextBetween(200, 500))
                ->setCategorie($categories->array_rand($categories));

            $manager->persist($produit);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoriesFixtures::class,
        ];
    }
}

