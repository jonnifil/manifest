<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoachRepository")
 * Сущность прыжок с инструктором (любого вида, кроме афф и тандема)
 */
class Coach
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
     * @ORM\ManyToOne(targetEntity="App\Entity\WorkDay", inversedBy="coaches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $work_day;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Flight", inversedBy="coaches")
     * @ORM\JoinColumn(nullable=true)
     */
    private $flight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="coach_clients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coach_client;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="coach_drivers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coach_driver;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="coach_operators")
     * @ORM\JoinColumn(nullable=true)
     */
    private $coach_operator;


    public function getWorkDay(): WorkDay
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCoachClient(): Member
    {
        return $this->coach_client;
    }

    public function setCoachClient(Member $client): self
    {
        $this->coach_client = $client;

        return $this;
    }

    public function getDriver(): ?Member
    {
        return $this->coach_driver;
    }

    public function setDriver(Member $driver): self
    {
        $this->coach_driver = $driver;

        return $this;
    }

    public function getOperator(): ?Member
    {
        return $this->coach_operator;
    }

    public function setOperator(Member $operator): self
    {
        $this->coach_operator = $operator;

        return $this;
    }
}
