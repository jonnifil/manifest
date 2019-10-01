<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 * Сущность Член клуба - любой человек, который может подняться в воздух в одном из Взлётов Компании
 * (инструктор, спортсмен, тандем-пассажир, покатушник и т.д.)
 */
class Member
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=125)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=125)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=125, nullable=true)
     */
    private $middle_name;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role")
     * @ORM\JoinTable(name="member_roles",
     *      joinColumns={@ORM\JoinColumn(name="member_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *      )
     */
    private $roles;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="members")
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tandem", mappedBy="passenger")
     */
    private $passengers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tandem", mappedBy="driver")
     */
    private $drivers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coach", mappedBy="driver")
     */
    private $coach_drivers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tandem", mappedBy="operator")
     */
    private $operators;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coach", mappedBy="coach_operator")
     */
    private $coach_operators;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coach", mappedBy="coach_client")
     */
    private $coach_clients;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aff", mappedBy="aff_client")
     */
    private $aff_clients;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aff", mappedBy="aff_firsts")
     */
    private $aff_firsts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aff", mappedBy="aff_seconds")
     */
    private $aff_seconds;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aff", mappedBy="aff_operators")
     */
    private $aff_operators;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Singleton", mappedBy="member")
     */
    private $singletons;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BigWay", mappedBy="lot")
     */
    private $lots;

    public function __construct()
    {
        $this->passengers = new ArrayCollection();
        $this->drivers = new ArrayCollection();
        $this->operators = new ArrayCollection();
        $this->coach_drivers = new ArrayCollection();
        $this->coach_operators = new ArrayCollection();
        $this->coach_clients = new ArrayCollection();
        $this->aff_clients = new ArrayCollection();
        $this->aff_firsts = new ArrayCollection();
        $this->aff_seconds = new ArrayCollection();
        $this->aff_operators = new ArrayCollection();
        $this->singletons = new ArrayCollection();
        $this->roles = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getLots()
    {
        return $this->lots;
    }

    /**
     * @return ArrayCollection
     */
    public function getPassengers()
    {
        return $this->passengers;
    }

    /**
     * @return ArrayCollection
     */
    public function getDrivers()
    {
        return $this->drivers;
    }

    /**
     * @return ArrayCollection
     */
    public function getOperators()
    {
        return $this->operators;
    }

    /**
     * @return ArrayCollection
     */
    public function getCoachClients()
    {
        return $this->coach_clients;
    }

    /**
     * @return ArrayCollection
     */
    public function getCoachDrivers()
    {
        return $this->coach_drivers;
    }

    /**
     * @return ArrayCollection
     */
    public function getCoachOperators()
    {
        return $this->coach_operators;
    }

    /**
     * @return ArrayCollection
     */
    public function getAffClients()
    {
        return $this->aff_clients;
    }

    /**
     * @return ArrayCollection
     */
    public function getAffFirsts()
    {
        return $this->aff_firsts;
    }

    /**
     * @return ArrayCollection
     */
    public function getAffSeconds()
    {
        return $this->aff_seconds;
    }

    /**
     * @return ArrayCollection
     */
    public function getAffOperators()
    {
        return $this->aff_operators;
    }

    /**
     * @return ArrayCollection
     */
    public function getSingletons()
    {
        return $this->singletons;
    }

    /**
     * @return ArrayCollection
     */
    public function getRoles()
    {
        return $this->roles;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

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

    public function getMiddleName(): ?string
    {
        return $this->middle_name;
    }

    public function setMiddleName(?string $middle_name): self
    {
        $this->middle_name = $middle_name;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }
}
