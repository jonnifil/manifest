<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AffRepository")
 */
class Aff
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\WorkDay", inversedBy="affs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $work_day;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Flight", inversedBy="affs")
     * @ORM\JoinColumn(nullable=true)
     */
    private $flight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="aff_clients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $aff_client;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="aff_firsts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $aff_first;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="aff_seconds")
     * @ORM\JoinColumn(nullable=true)
     */
    private $aff_second;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="aff_operators")
     * @ORM\JoinColumn(nullable=true)
     */
    private $aff_operator;

    /**
     * @ORM\Column(type="smallint")
     */
    private $level;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorkDay(): ?WorkDay
    {
        return $this->work_day;
    }

    public function setWorkDay(WorkDay $work_day): self
    {
        $this->work_day = $work_day;

        return $this;
    }

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(Flight $flight): self
    {
        $this->flight = $flight;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getAffClient(): Member
    {
        return $this->aff_client;
    }

    public function setAffClient(Member $client): self
    {
        $this->aff_client = $client;

        return $this;
    }

    public function getAffFirst(): ?Member
    {
        return $this->aff_first;
    }

    public function setAffFirst(Member $first): self
    {
        $this->aff_first = $first;

        return $this;
    }

    public function getAffSecond(): ?Member
    {
        return $this->aff_second;
    }

    public function setAffSecond(Member $second): self
    {
        $this->aff_second = $second;

        return $this;
    }

    public function getAffOperator(): ?Member
    {
        return $this->aff_operator;
    }

    public function setOperator(Member $operator): self
    {
        $this->aff_operator = $operator;

        return $this;
    }
}
