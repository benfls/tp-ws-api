<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use EasyApiBundle\Entity\AbstractBaseEntity;

/**
* @ORM\Entity()
*/
class Author extends AbstractBaseEntity
{
    /**
    * @ORM\Column(type="string")
    */
    protected ?string $name = null;

    /**
    * @ORM\Column(type="string", nullable=true)
    */
    protected ?string $biography = null;

    /**
    * @ORM\Column(type="string", nullable=true)
    */
    protected ?string $nationality = null;

    /**
    * @return string|null
    */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
    * @param string|null $name
    */
    public function setName(?string $name): void
    {
    $this->name = $name;
    }

    /**
    * @return string|null
    */
    public function getBiography(): ?string
    {
        return $this->biography;
    }

    /**
    * @param string|null $biography
    */
    public function setBiography(?string $biography): void
    {
        $this->biography = $biography;
    }

    /**
    * @return string|null
    */
    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    /**
    * @param string|null $nationality
    */
    public function setNationality(?string $nationality): void
    {
        $this->nationality = $nationality;
    }

    /**
     * @ORM\OneToMany(targetEntity=Book::class, mappedBy="author")
     */
    protected Collection $books;

    public function __construct()
    {
        parent::__construct();
        $this->books = new ArrayCollection();
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setAuthor($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getAuthor() === $this) {
                $book->setAuthor(null);
            }
        }

        return $this;
    }
}
