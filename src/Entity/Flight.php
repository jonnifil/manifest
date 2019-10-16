<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FlightRepository")
 * сущность Взлёт
 */
class Flight
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
    private $number;

    /**
     * @ORM\Column(type="smallint")
     */
    private $type;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\Column(type="time")
     */
    private $start_time;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\WorkDay", inversedBy="flights")
     * @ORM\JoinColumn(nullable=false)
     */
    private $work_day;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tandem", mappedBy="flight")
     */
    private $tandems;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aff", mappedBy="flight")
     */
    private $affs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coach", mappedBy="flight")
     */
    private $coaches;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Singleton", mappedBy="flight")
     */
    private $singletons;

    public function __construct()
    {
        $this->tandems = new ArrayCollection();
        $this->affs = new ArrayCollection();
        $this->coaches = new ArrayCollection();
        $this->singletons = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getTandems()
    {
        return $this->tandems;
    }

    /**
     * @return ArrayCollection
     */
    public function getAffs()
    {
        return $this->affs;
    }

    /**
     * @return ArrayCollection
     */
    public function getCoaches()
    {
        return $this->coaches;
    }

    /**
     * @return ArrayCollection
     */
    public function getSingletons()
    {
        return $this->singletons;
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->start_time;
    }

    public function setStartTime(\DateTimeInterface $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getDisplayName()
    {
        return 'Взлёт № ' . $this->getNumber();
    }
}
