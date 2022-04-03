<?php

namespace App\Entity;

use App\Repository\SuiteRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: SuiteRepository::class)]

class Suite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $night_price;

    #[ORM\ManyToOne(targetEntity: Hotel::class, inversedBy: 'suite')]
    private $hotel;



    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNightPrice(): ?int
    {
        return $this->night_price;
    }

    public function setNightPrice(int $night_price): self
    {
        $this->night_price = $night_price;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }


}
