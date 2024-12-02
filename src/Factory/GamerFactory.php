<?php

namespace App\Factory;

use App\Entity\Gamer;
use App\Repository\GamerRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Gamer>
 *
 * @method        Gamer|Proxy create(array|callable $attributes = [])
 * @method static Gamer|Proxy createOne(array $attributes = [])
 * @method static Gamer|Proxy find(object|array|mixed $criteria)
 * @method static Gamer|Proxy findOrCreate(array $attributes)
 * @method static Gamer|Proxy first(string $sortedField = 'id')
 * @method static Gamer|Proxy last(string $sortedField = 'id')
 * @method static Gamer|Proxy random(array $attributes = [])
 * @method static Gamer|Proxy randomOrCreate(array $attributes = [])
 * @method static GamerRepository|RepositoryProxy repository()
 * @method static Gamer[]|Proxy[] all()
 * @method static Gamer[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Gamer[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Gamer[]|Proxy[] findBy(array $attributes)
 * @method static Gamer[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Gamer[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class GamerFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'email' => self::faker()->email(180),
            'fullName' => self::faker()->name(255),
            'image' => self::faker()->randomElement(["user1-128x128.jpg","user2-128x128.jpg","user3-128x128.jpg","user4-128x128.jpg","user5-128x128.jpg","user6-128x128.jpg","user7-128x128.jpg","user8-128x128.jpg"]),
            'password' => self::faker()->password(),
            'roles' => [],
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Gamer $gamer): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Gamer::class;
    }
}
