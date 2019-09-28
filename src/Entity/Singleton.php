<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SingletonRepository")
 */
class Singleton
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Flight", inversedBy="singletons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $flight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="singletons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $member;

    public function getFlight(): Flight
    {
        return $this->flight;
    }

    public function setFlight(Flight $flight): self
    {
        $this->flight = $flight;

        return $this;
    }

    public function getMember(): Member
    {
        return $this->flight;
    }

    public function setMember(Member $flight): self
    {
        $this->flight = $flight;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }
}
