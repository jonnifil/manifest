<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TandemRepository")
 */
class Tandem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\WorkDay", inversedBy="tandems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $work_day;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Flight", inversedBy="tandems")
     * @ORM\JoinColumn(nullable=true)
     */
    private $flight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="passengers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $passenger;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="drivers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $driver;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="operators")
     * @ORM\JoinColumn(nullable=true)
     */
    private $operator;

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

    public function getPassenger(): ?Member
    {
        return $this->passenger;
    }

    public function setPassenger(Member $passenger): self
    {
        $this->passenger = $passenger;

        return $this;
    }

    public function getDriver(): ?Member
    {
        return $this->driver;
    }

    public function setDriver(Member $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function getOperator(): ?Member
    {
        return $this->operator;
    }

    public function setOperator(Member $operator): self
    {
        $this->operator = $operator;

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
}
