<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EtudiantFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*$faker = Factory::create('fr_FR');
        for ($i = 0 ; $i < 100; $i++){
            $etudiant = new Etudiant();
            $etudiant
                ->setNomE($faker->words(3,true))
                ->setPrenomE($faker>words(3, true))
            ->setNationaliteE($faker->words(3,true))
            ->setSexeE($faker->words(3,true))
            ->setDateNaissanceE($faker->dateTime('now','Paris'));
            $manager->persist($etudiant);
        }*/
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
