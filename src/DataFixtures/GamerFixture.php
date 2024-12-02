<?php

namespace App\DataFixtures;

use App\Factory\GameFactory;
use App\Factory\GamerFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GamerFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        GamerFactory::new()
            ->many(20)
            ->create(function (){
                return [
                    'game' => GameFactory::random(),
                ];
            });

        $manager->flush();
    }


    public function getDependencies(): array
    {
        return [
            GameFixture::class,
        ];
    }

}