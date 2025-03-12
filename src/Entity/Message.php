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
     * @ORM\Column(type="string")
     */
    private string $content;

    /**
     * @ORM\Column(type="string")
     */
    private string $type; // "text" ou "image"

    public function getContent(): string { return $this->content; }
    public function setContent(string $content): void { $this->content = $content; }

    public function getType(): string { return $this->type; }
    public function setType(string $type): void { $this->type = $type; }

}
