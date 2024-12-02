<?php

namespace App\DataFixtures;


use App\Factory\FollowersFactory;
use App\Factory\GamerFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FollowersFixture extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {

        FollowersFactory::new()
            ->many(20)
            ->create(function (){
                return [
                    'gamer' => GamerFactory::random(),
                    'followedBy' => GamerFactory::random(),
                ];
            });

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            GamerFixture::class
        ];
    }

}