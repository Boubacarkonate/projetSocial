<?php

namespace App\Entity;

use App\Repository\ForfaitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForfaitRepository::class)]
class Forfait
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'forfait', targetEntity: Commandes::class, orphanRemoval: true)]
    private Collection $commandes_id;

    public function __construct()
    {
        $this->commandes_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Commandes>
     */
    public function getCommandesId(): Collection
    {
        return $this->commandes_id;
    }

    public function addCommandesId(Commandes $commandesId): static
    {
        if (!$this->commandes_id->contains($commandesId)) {
            $this->commandes_id->add($commandesId);
            $commandesId->setForfaitId($this);
        }

        return $this;
    }

    public function removeCommandesId(Commandes $commandesId): static
    {
        if ($this->commandes_id->removeElement($commandesId)) {
            // set the owning side to null (unless already changed)
            if ($commandesId->getForfaitId() === $this) {
                $commandesId->setForfaitId(null);
            }
        }

        return $this;
    }
}
