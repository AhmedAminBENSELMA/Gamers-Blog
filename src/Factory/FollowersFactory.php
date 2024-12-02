<?php

namespace App\Factory;

use App\Entity\Followers;
use App\Repository\FollowersRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Followers>
 *
 * @method        Followers|Proxy create(array|callable $attributes = [])
 * @method static Followers|Proxy createOne(array $attributes = [])
 * @method static Followers|Proxy find(object|array|mixed $criteria)
 * @method static Followers|Proxy findOrCreate(array $attributes)
 * @method static Followers|Proxy first(string $sortedField = 'id')
 * @method static Followers|Proxy last(string $sortedField = 'id')
 * @method static Followers|Proxy random(array $attributes = [])
 * @method static Followers|Proxy randomOrCreate(array $attributes = [])
 * @method static FollowersRepository|RepositoryProxy repository()
 * @method static Followers[]|Proxy[] all()
 * @method static Followers[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Followers[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Followers[]|Proxy[] findBy(array $attributes)
 * @method static Followers[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Followers[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class FollowersFactory extends ModelFactory
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
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Followers $followers): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Followers::class;
    }
}
