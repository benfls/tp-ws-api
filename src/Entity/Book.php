<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use EasyApiBundle\Entity\AbstractBaseEntity;

/**
 * @ORM\Entity()
 */
class Book extends AbstractBaseEntity
{
    /**
     * @ORM\Column(type="string")
     */
    protected ?string $title = null;

    /**
     * @ORM\Column(type="string")
     */
    protected ?string $author = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected ?string $summary = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected ?int $year = null;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string|null $author
     */
    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return string|null
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * @param string|null $summary
     */
    public function setSummary(?string $summary): void
    {
        $this->summary = $summary;
    }

    /**
     * @return int|null
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * @param int|null $year
     */
    public function setYear(?int $year): void
    {
        $this->year = $year;
    }

}