<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'notifications')]
    private ?Gamer $owner = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Gamer $actionAccount = null;

    #[ORM\Column]
    private ?bool $isSeen = null;

    #[ORM\ManyToOne]
    private ?Post $post = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?Gamer
    {
        return $this->owner;
    }

    public function setOwner(?Gamer $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getActionAccount(): ?Gamer
    {
        return $this->actionAccount;
    }

    public function setActionAccount(?Gamer $actionAccount): static
    {
        $this->actionAccount = $actionAccount;

        return $this;
    }

    public function isIsSeen(): ?bool
    {
        return $this->isSeen;
    }

    public function setIsSeen(bool $isSeen): static
    {
        $this->isSeen = $isSeen;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): static
    {
        $this->post = $post;

        return $this;
    }
}
