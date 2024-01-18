<?php

namespace App\Entity;

use App\Repository\BlogArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Cocur\Slugify\Slugify;

#[ORM\Entity(repositoryClass: BlogArticleRepository::class)]
class BlogArticle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_slug = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Image $image = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'blogArticles')]
    private Collection $tags;

    #[ORM\ManyToOne(inversedBy: 'BlogArticles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BlogTheme $theme = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: BlogCommentaire::class, orphanRemoval: true)]
    private Collection $blogCommentaires;

    #[ORM\ManyToMany(targetEntity: AdminUser::class, inversedBy: "blogArticles")]
    private Collection $users;

    public function __construct()
    {
        $this->user_login = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->blogCommentaires = new ArrayCollection();
        $this->users = new ArrayCollection();

        $this->date = new \DateTime('now');
    
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

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $slugify = new Slugify();

        $this->titre = $titre;
        $this->titre_slug = $slugify->slugify($titre);
        return $this;
    }

    public function getTitreSlug(): ?string
    {
        return $this->titre_slug;
    }

    public function setTitreSlug(string $titre_slug): static
    {
        $this->titre_slug = $titre_slug;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, AdminUser>
     */
    public function getUserLogin(): Collection
    {
        return $this->user_login;
    }

    public function addUserLogin(AdminUser $userLogin): static
    {
        if (!$this->user_login->contains($userLogin)) {
            $this->user_login->add($userLogin);
        }

        return $this;
    }

    public function removeUserLogin(AdminUser $userLogin): static
    {
        $this->user_login->removeElement($userLogin);

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getTheme(): ?BlogTheme
    {
        return $this->theme;
    }

    public function setTheme(?BlogTheme $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @return Collection<int, BlogCommentaire>
     */
    public function getBlogCommentaires(): Collection
    {
        return $this->blogCommentaires;
    }

    public function addBlogCommentaire(BlogCommentaire $blogCommentaire): static
    {
        if (!$this->blogCommentaires->contains($blogCommentaire)) {
            $this->blogCommentaires->add($blogCommentaire);
            $blogCommentaire->setArticle($this);
        }

        return $this;
    }

    public function removeBlogCommentaire(BlogCommentaire $blogCommentaire): static
    {
        if ($this->blogCommentaires->removeElement($blogCommentaire)) {
            // set the owning side to null (unless already changed)
            if ($blogCommentaire->getArticle() === $this) {
                $blogCommentaire->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AdminUser>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(AdminUser $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(AdminUser $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }


    public function __toString(): string
    {
        return $this->titre;
    }
}
