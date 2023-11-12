<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $isbn = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(length: 20)]
    private ?string $author = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $nbPages = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $editor = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $bookCover = null;


    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'datetime_immutable', options: ['default'=>'CURRENT_TIMESTAMP'])]
    #[Gedmo\Timestampable(on:'create')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Library $fklibraries = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Kind $fkkinds = null;

    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString(){
        return $this->title;
    }
    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getNbPages(): ?string
    {
        return $this->nbPages;
    }

    public function setNbPages(?string $nbPages): static
    {
        $this->nbPages = $nbPages;

        return $this;
    }

    public function getEditor(): ?string
    {
        return $this->editor;
    }

    public function setEditor(?string $editor): static
    {
        $this->editor = $editor;

        return $this;
    }

    public function getBookCover(): ?string
    {
        return $this->bookCover;
    }

    public function setBookCover(?string $bookCover): static
    {
        $this->bookCover = $bookCover;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /* public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    } */

    public function getFklibraries(): ?Library
    {
        return $this->fklibraries;
    }

    public function setFklibraries(?Library $fklibraries): static
    {
        $this->fklibraries = $fklibraries;

        return $this;
    }

    public function getFkkinds(): ?Kind
    {
        return $this->fkkinds;
    }

    public function setFkkinds(?Kind $fkkinds): static
    {
        $this->fkkinds = $fkkinds;

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
            $comment->setBooks($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getBooks() === $this) {
                $comment->setBooks(null);
            }
        }

        return $this;
    }
}
