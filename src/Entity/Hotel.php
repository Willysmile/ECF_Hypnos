<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
class Hotel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    private $address;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\OneToOne(mappedBy: 'hotel', targetEntity: Manager::class, cascade: ['persist', 'remove'])]
    private $manager;

    #[ORM\OneToMany(mappedBy: 'hotel', targetEntity: suite::class)]
    private $suite;

    public function __construct()
    {
        $this->suite = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }


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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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

    public function getManager(): ?Manager
    {
        return $this->manager;
    }

    public function setManager(?Manager $manager): self
    {
        // unset the owning side of the relation if necessary
        if ($manager === null && $this->manager !== null) {
            $this->manager->setHotel(null);
        }

        // set the owning side of the relation if necessary
        if ($manager !== null && $manager->getHotel() !== $this) {
            $manager->setHotel($this);
        }

        $this->manager = $manager;

        return $this;
    }

    /**
     * @return Collection<int, suite>
     */
    public function getSuite(): Collection
    {
        return $this->suite;
    }

    public function addSuite(suite $suite): self
    {
        if (!$this->suite->contains($suite)) {
            $this->suite[] = $suite;
            $suite->setHotel($this);
        }

        return $this;
    }

    public function removeSuite(suite $suite): self
    {
        if ($this->suite->removeElement($suite)) {
            // set the owning side to null (unless already changed)
            if ($suite->getHotel() === $this) {
                $suite->setHotel(null);
            }
        }

        return $this;
    }
}
