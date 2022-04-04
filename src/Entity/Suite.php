<?php

namespace App\Entity;

use App\Repository\SuiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'suite', targetEntity: ImagesSuite::class, cascade: ['persist', 'remove'])]
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
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

    /**
     * @return Collection<int, ImagesSuite>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ImagesSuite $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setSuite($this);
        }

        return $this;
    }

    public function removeImage(ImagesSuite $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getSuite() === $this) {
                $image->setSuite(null);
            }
        }

        return $this;
    }


}
