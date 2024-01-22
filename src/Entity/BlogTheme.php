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

    #[ORM\OneToMany(mappedBy: 'theme', targetEntity: BlogArticle::class)]
    private Collection $BlogArticles;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?AdminLog $_created = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?AdminLog $_updated = null;

    public function __construct()
    {
        $this->BlogArticles = new ArrayCollection();
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
     * @return Collection<int, BlogArticle>
     */
    public function getBlogArticles(): Collection
    {
        return $this->BlogArticles;
    }

    public function addBlogArticle(BlogArticle $BlogArticle): static
    {
        if (!$this->BlogArticles->contains($BlogArticle)) {
            $this->BlogArticles->add($BlogArticle);
            $BlogArticle->setTheme($this);
        }

        return $this;
    }

    public function removeBlogArticle(BlogArticle $BlogArticle): static
    {
        if ($this->BlogArticles->removeElement($BlogArticle)) {
            // set the owning side to null (unless already changed)
            if ($BlogArticle->getTheme() === $this) {
                $BlogArticle->setTheme(null);
            }
        }

        return $this;
    }




    public function __toString(): string
    {
        return $this->lib;
    }

    public function getCreated(): ?AdminLog
    {
        return $this->_created;
    }

    public function setCreated(AdminLog $_created): static
    {
        $this->_created = $_created;

        return $this;
    }

    public function getUpdated(): ?AdminLog
    {
        return $this->_updated;
    }

    public function setUpdated(?AdminLog $_updated): static
    {
        $this->_updated = $_updated;

        return $this;
    }
}
