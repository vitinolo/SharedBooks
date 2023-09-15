<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookRepository;
use Gedmo\Mapping\Annotation as Gedmo;

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

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $lendTo = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $lentDate = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $nbPages = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $editor = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $bookCover = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $publicationDate = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'datetime_immutable', options: ['default'=>'CURRENT_TIMESTAMP'])]
    #[Gedmo\Timestampable(on:'create')]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLendTo(): ?string
    {
        return $this->lendTo;
    }

    public function setLendTo(?string $lendTo): static
    {
        $this->lendTo = $lendTo;

        return $this;
    }

    public function getLentDate(): ?string
    {
        return $this->lentDate;
    }

    public function setLentDate(?string $lentDate): static
    {
        $this->lentDate = $lentDate;

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

    public function getPublicationDate(): ?string
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(?string $publicationDate): static
    {
        $this->publicationDate = $publicationDate;

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
}
