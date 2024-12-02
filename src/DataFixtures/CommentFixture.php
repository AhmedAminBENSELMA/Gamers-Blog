<?php

namespace App\DataFixtures;


use App\Factory\CommentFactory;
use App\Factory\GamerFactory;
use App\Factory\PostFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixture extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {

        CommentFactory::new()
            ->many(50)
            ->create(function (){
                return [
                    'account' => GamerFactory::random(),
                    'post' => PostFactory::random(),
                ];
            });

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            GamerFixture::class,
            PostFixture::class
        ];
    }

}