<?php

namespace App\Entity;

use App\Repository\GameRepository;
use App\Service\UploadFileService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Gamer::class)]
    private Collection $gamers;

    public function __construct()
    {
        $this->gamers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Gamer>
     */
    public function getGamers(): Collection
    {
        return $this->gamers;
    }

    public function addGamer(Gamer $gamer): static
    {
        if (!$this->gamers->contains($gamer)) {
            $this->gamers->add($gamer);
            $gamer->setGame($this);
        }

        return $this;
    }

    public function removeGamer(Gamer $gamer): static
    {
        if ($this->gamers->removeElement($gamer)) {
            // set the owning side to null (unless already changed)
            if ($gamer->getGame() === $this) {
                $gamer->setGame(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
    public  function  getImagePath() :string
    {
        return 'uploads/'.UploadFileService::Directories[UploadFileService::ImageType].'/' . $this->getImage();
    }
}
