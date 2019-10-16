<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
{
    const NO_JUMP = 1;
    const SINGLETON = 2;
    const TANDEM_CLIENT = 3;
    const AFF_CLIENT = 4;
    const WS_USER = 5;
    const RW_USER = 6;
    const FF_USER = 7;
    const RW_COACH = 8;
    const FF_COACH = 9;
    const WS_COACH = 10;
    const RW_LOT = 11;
    const FF_LOT = 12;
    const WS_LOT = 13;
    const TANDEM_MASTER = 14;
    const AFF_FIRST = 15;
    const AFF_SECOND = 16;
    const OPERATOR = 17;

    const WORKERS = [
        self::TANDEM_MASTER,
        self::AFF_FIRST,
        self::AFF_SECOND,
        self::OPERATOR,
        self::RW_COACH,
        self::FF_COACH,
        self::WS_COACH,
        self::RW_LOT,
        self::FF_LOT,
        self::WS_LOT,
    ];


    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=125)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     * for choices
     */
    public function getDisplayName()
    {
        return $this->name;
    }
}
