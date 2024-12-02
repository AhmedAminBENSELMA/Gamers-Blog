<?php

namespace App\Entity;

use App\Repository\PostRepository;
use App\Service\UploadFileService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Gamer $gamer = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $context = null;

    #[ORM\Column]
    private ?int $likes = 0;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $video = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

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

    public function getContext(): ?string
    {
        return $this->context;
    }
    public function getContextSub(): ?string
    {
        return mb_substr($this->context, 0, 90, 'UTF-8').' ...';
    }
    public function setContext(string $context): static
    {
        $this->context = $context;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): static
    {
        $this->likes = $likes;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): static
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }


    public  function  getVideoPath() :string
    {
        return 'uploads/'.UploadFileService::Directories[UploadFileService::VideoType].'/' . $this->getVideo();
    }
}
