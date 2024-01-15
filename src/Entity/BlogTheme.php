<?php

namespace App\Entity;

use App\Repository\BlogThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogThemeRepository::class)]
class BlogTheme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lib = null;

    #[ORM\OneToMany(mappedBy: 'theme', targetEntity: Blogarticle::class)]
    private Collection $blogarticles;

    public function __construct()
    {
        $this->blogarticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getLib(): ?string
    {
        return $this->lib;
    }

    public function setLib(string $lib): static
    {
        $this->lib = $lib;

        return $this;
    }

    /**
     * @return Collection<int, Blogarticle>
     */
    public function getBlogarticles(): Collection
    {
        return $this->blogarticles;
    }

    public function addBlogarticle(Blogarticle $blogarticle): static
    {
        if (!$this->blogarticles->contains($blogarticle)) {
            $this->blogarticles->add($blogarticle);
            $blogarticle->setTheme($this);
        }

        return $this;
    }

    public function removeBlogarticle(Blogarticle $blogarticle): static
    {
        if ($this->blogarticles->removeElement($blogarticle)) {
            // set the owning side to null (unless already changed)
            if ($blogarticle->getTheme() === $this) {
                $blogarticle->setTheme(null);
            }
        }

        return $this;
    }
}
