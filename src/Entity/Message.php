<?php

namespace App\Entity;

use EasyApiBundle\Entity\AbstractBaseEntity;

/**
 * @ORM\Entity()
 */
class Message extends AbstractBaseEntity
{
    /**
     * @ORM\Column(type="text")
     * @Groups({"message_read", "message_write"})
     */
    private string $content;

}
