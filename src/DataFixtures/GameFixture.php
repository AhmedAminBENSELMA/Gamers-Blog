<?php

namespace App\DataFixtures;

use App\Factory\GameFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GameFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        GameFactory::createMany(3);


        $manager->flush();
    }
}