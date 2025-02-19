<?php

namespace App\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use EasyApiJwtAuthentication\Entity\AbstractExtendedUser;

/**
 * User.
 * @ORM\Entity()
 * @ORM\Table(name="`user`")
 */
class User extends AbstractExtendedUser
{
    /**
     * @ORM\Column(type="string")
     */
    protected ?string $firstname = null;

    /**
     * @ORM\Column(type="string")
     */
    protected ?string $lastname = null;

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     */
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     */
    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

}
