<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 * Сущность Компания
 */
class Company
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128, options={"comment" : "Название компании"})
     */
    private $company_name;

    /**
     * @ORM\Column(type="integer", options={"default": 0, "comment" : "Часовой пояс от Москвы"})
     */
    private $time_zone;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="company")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WorkDay", mappedBy="company")
     */
    private $work_days;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Member", mappedBy="company")
     */
    private $members;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->work_days = new ArrayCollection();
        $this->members = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @return ArrayCollection
     */
    public function getWorkDays()
    {
        return $this->work_days;
    }

    /**
     * @return ArrayCollection
     */
    public function getMembers()
    {
        return $this->work_days;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->company_name;
    }

    public function setCompanyName(string $company_name): self
    {
        $this->company_name = $company_name;

        return $this;
    }

    public function getTimeZone(): ?int
    {
        return $this->time_zone;
    }

    public function setTimeZone(int $time_zone): self
    {
        $this->time_zone = $time_zone;

        return $this;
    }

    public function getCurrentDateTime()
    {
        $dateTime = new \DateTime('now');
        $interval = new \DateInterval('P'.$this->time_zone."H");
        return $dateTime->add($interval);
    }
}
