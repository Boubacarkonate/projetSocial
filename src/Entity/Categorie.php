<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $sector = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: AnnonceEmploi::class)]
    private Collection $annonceEmplois;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Cv::class)]
    private Collection $cvs;

   

   


   

    public function __construct()
    {
        $this->annonceEmplois = new ArrayCollection();
        $this->cvs = new ArrayCollection();
       
      
       
       
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSector(): ?string
    {
        return $this->sector;
    }

    public function setSector(string $sector): static
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * @return Collection<int, AnnonceEmploi>
     */
    public function getAnnonceEmplois(): Collection
    {
        return $this->annonceEmplois;
    }

    public function addAnnonceEmploi(AnnonceEmploi $annonceEmploi): static
    {
        if (!$this->annonceEmplois->contains($annonceEmploi)) {
            $this->annonceEmplois->add($annonceEmploi);
            $annonceEmploi->setCategorie($this);
        }

        return $this;
    }

    public function removeAnnonceEmploi(AnnonceEmploi $annonceEmploi): static
    {
        if ($this->annonceEmplois->removeElement($annonceEmploi)) {
            // set the owning side to null (unless already changed)
            if ($annonceEmploi->getCategorie() === $this) {
                $annonceEmploi->setCategorie(null);
            }
        }

        return $this;
    }

   

    public function __toString()
    {
        return $this->sector;            //méthode magique => convertisseur en string
    }

    /**
     * @return Collection<int, Cv>
     */
    public function getCvs(): Collection
    {
        return $this->cvs;
    }

    public function addCv(Cv $cv): static
    {
        if (!$this->cvs->contains($cv)) {
            $this->cvs->add($cv);
            $cv->setCategorie($this);
        }

        return $this;
    }

    public function removeCv(Cv $cv): static
    {
        if ($this->cvs->removeElement($cv)) {
            // set the owning side to null (unless already changed)
            if ($cv->getCategorie() === $this) {
                $cv->setCategorie(null);
            }
        }

        return $this;
    }

   

}
