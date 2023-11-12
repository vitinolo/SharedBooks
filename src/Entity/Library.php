<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LibraryRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: LibraryRepository::class)]
class Library
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $name = null;

    #[ORM\Column(type: 'datetime_immutable', options: ['default'=>'CURRENT_TIMESTAMP'])]
    #[Gedmo\Timestampable(on:'create')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'libraries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $fkusers = null;

    #[ORM\OneToMany(mappedBy: 'fklibraries', targetEntity: Book::class)]
    private Collection $books;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $image = null;

    #[ORM\OneToMany(mappedBy: 'Libraries', targetEntity: Kind::class)]
    private Collection $kinds;

    public function __construct()
    {
        $this->books = new ArrayCollection();
        $this->kinds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString(){
        return $this->name;
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /* public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    } */

    public function getFkusers(): ?User
    {
        return $this->fkusers;
    }

    public function setFkusers(?User $fkusers): static
    {
        $this->fkusers = $fkusers;

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): static
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setFklibraries($this);
        }

        return $this;
    }

    public function removeBook(Book $book): static
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getFklibraries() === $this) {
                $book->setFklibraries(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Kind>
     */
    public function getKinds(): Collection
    {
        return $this->kinds;
    }

    public function addKind(Kind $kind): static
    {
        if (!$this->kinds->contains($kind)) {
            $this->kinds->add($kind);
            $kind->setLibraries($this);
        }

        return $this;
    }

    public function removeKind(Kind $kind): static
    {
        if ($this->kinds->removeElement($kind)) {
            // set the owning side to null (unless already changed)
            if ($kind->getLibraries() === $this) {
                $kind->setLibraries(null);
            }
        }

        return $this;
    }
}
