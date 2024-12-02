<?php

namespace App\DataFixtures;

use App\Factory\GamerFactory;
use App\Factory\NotificationFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class NotificationFixture extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {


        NotificationFactory::new()
            ->many(20)
            ->create(function (){
                return [
                    'actionAccount' => GamerFactory::random(),
                    'owner' => GamerFactory::random(),
                ];
            });


        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            GamerFixture::class,
        ];
    }

}