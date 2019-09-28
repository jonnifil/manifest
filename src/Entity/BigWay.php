<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BigWayRepository")
 */
class BigWay
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
     * @ORM\ManyToOne(targetEntity="App\Entity\WorkDay", inversedBy="big_ways")
     * @ORM\JoinColumn(nullable=false)
     */
    private $work_day;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Flight", inversedBy="big_ways")
     * @ORM\JoinColumn(nullable=true)
     */
    private $flight;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Member")
     * @ORM\JoinTable(name="big_way_members",
     *      joinColumns={@ORM\JoinColumn(name="big_way_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="member_id", referencedColumnName="id")}
     *      )
     */
    private $members;

    public function __construct()
    {
        $this->members = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="boolean")
     */
    private $with_lot;

    /**
     * ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="lots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lot;

    /**
     * ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="bw_operators")
     * @ORM\JoinColumn(nullable=true)
     */
    private $operator;

    /**
     * @return ArrayCollection
     */
    public function getMembers()
    {
        return $this->members;
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

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getWithLot(): ?bool
    {
        return $this->with_lot;
    }

    public function setWithLot(bool $with_lot): self
    {
        $this->with_lot = $with_lot;

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

    public function getLot(): ?Member
    {
        return $this->lot;
    }

    public function setLot(Member $operator): self
    {
        $this->lot = $operator;

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
}
