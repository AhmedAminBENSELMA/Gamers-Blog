<?php

namespace App\Entity;

use App\Repository\FollowersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FollowersRepository::class)]
class Followers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'followers')]
    private ?Gamer $gamer = null;

    #[ORM\ManyToOne(inversedBy: 'followers')]
    private ?Gamer $followedby = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGamer(): ?Gamer
    {
        return $this->gamer;
    }

    public function setGamer(?Gamer $gamer): static
    {
        $this->gamer = $gamer;

        return $this;
    }

    public function getFollowedby(): ?Gamer
    {
        return $this->followedby;
    }

    public function setFollowedby(?Gamer $followedby): static
    {
        $this->followedby = $followedby;

        return $this;
    }
}
