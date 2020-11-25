<?php

namespace App\DataFixtures;
use App\Entity\Customer;
use App\Entity\Dom;
use App\Entity\Auto;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $customer = new Customer();
            $customer->setName($faker->name);
            $customer->setSurname($faker->LastName);
            $customer->setEmail($faker->email);
            $customer->setPhone($faker->numberBetween($min=1 ,$max=10));
            $manager->persist($customer);
             
            $auto = new Auto();
            $auto->setMarka($faker->name);
            $auto->setRokProd($faker->dateTime());
            $auto->setColor($faker->sentence(1));
            $manager->persist($auto);
            
            $dom = new Dom();
            $dom->setModel($faker->name);
            $dom->setData($faker->dateTime());
           
            $manager->persist($dom);
        }
       

        $manager->flush();
    }
}
