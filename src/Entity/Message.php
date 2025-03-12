<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use EasyApiBundle\Entity\AbstractBaseEntity;

/**
 * @ORM\Entity()
 */
class Message extends AbstractBaseEntity
{
    /**
     * @ORM\Column(type="text")
     */
    private string $content_text;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private string $type; // "text" ou "image"

    public function getContent(): string { return $this->content_text; }
    public function setContent(string $content): void { $this->content_text = $content; }

    public function getType(): string { return $this->type; }
    public function setType(string $type): void { $this->type = $type; }

}
