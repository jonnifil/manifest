<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkDayRepository")
 * Сущность Прыжковый день
 */
class WorkDay
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $day;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="work_days")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Member")
     * @ORM\JoinTable(name="work_day_members",
     *      joinColumns={@ORM\JoinColumn(name="work_day_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="member_id", referencedColumnName="id")}
     *      )
     */
    private $members;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flight", mappedBy="work_day")
     */
    private $flights;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tandem", mappedBy="work_day")
     */
    private $tandems;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aff", mappedBy="work_day")
     */
    private $affs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coach", mappedBy="work_day")
     */
    private $coaches;

    public function __construct()
    {
        $this->flights = new ArrayCollection();
        $this->members = new ArrayCollection();
        $this->tandems = new ArrayCollection();
        $this->affs = new ArrayCollection();
        $this->coaches = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getFlights()
    {
        return $this->flights;
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
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @return array
     */
    public function getMemberIds()
    {
        $ids = [];
        if ($this->members) {
            foreach ($this->members as $member)
                $ids[] = $member->getId();
        }
        return $ids;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(Company $company): self
    {
        $this->company = $company;

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?\DateTimeInterface
    {
        return $this->day;
    }

    public function setDay(\DateTimeInterface $day): self
    {
        $this->day = $day;

        return $this;
    }
}
