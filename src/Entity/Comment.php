<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $post = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Gamer $account = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentContext = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAccount(): ?Gamer
    {
        return $this->account;
    }

    public function setAccount(?Gamer $account): static
    {
        $this->account = $account;

        return $this;
    }

    public function getCommentContext(): ?string
    {
        return $this->commentContext;
    }

    public function setCommentContext(string $commentContext): static
    {
        $this->commentContext = $commentContext;

        return $this;
    }
}
