<?php

namespace App\Entity;

use App\Repository\StudentsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StudentsRepository::class)]
class Students
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private ?string $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $lastname;

    #[ORM\Column(type: 'integer')]
    private ?int $age;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $team;

    #[ORM\Column(type: 'integer')]
    private ?int $firstQuarter;

    #[ORM\Column(type: 'integer')]
    private ?int $secondQuarter;

    #[ORM\Column(type: 'integer')]
    private ?int $lastQuarter;

    #[ORM\Column(type: 'boolean')]
    private ?bool $active;

    #[ORM\Column(type: 'integer')]
    //#[Assert\Regex(
        //pattern: '',
       // message: 'Format invalide'
   // )]

    private $phone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getTeam(): ?string
    {
        return $this->team;
    }

    public function setTeam(string $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getFirstQuarter(): ?int
    {
        return $this->firstQuarter;
    }

    public function setFirstQuarter(int $firstQuarter): self
    {
        $this->firstQuarter = $firstQuarter;

        return $this;
    }

    public function getSecondQuarter(): ?int
    {
        return $this->secondQuarter;
    }

    public function setSecondQuarter(int $secondQuarter): self
    {
        $this->secondQuarter = $secondQuarter;

        return $this;
    }

    public function getLastQuarter(): ?int
    {
        return $this->lastQuarter;
    }

    public function setLastQuarter(int $lastQuarter): self
    {
        $this->lastQuarter = $lastQuarter;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
