<?php

namespace App\DataFixtures;

use App\Factory\AccountFactory;
use App\Factory\GamerFactory;
use App\Factory\PostFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        PostFactory::new()
            ->many(20)
            ->create(function (){
                return [
                    'gamer' => GamerFactory::random(),
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