<?php

namespace App\Entity;

use App\Repository\AdminUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: AdminUserRepository::class)]
class AdminUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'user_login', targetEntity: AdminLog::class)]
    private Collection $logs;

    #[ORM\OneToMany(mappedBy: 'user_login', targetEntity: AdminAccessLog::class)]
    private Collection $accesslogs;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    private ?AdminUserRole $role = null;

    #[ORM\ManyToMany(targetEntity: BlogArticle::class, mappedBy: 'users')]
    private Collection $blogArticles;

    #[ORM\OneToOne(cascade: ['persist'])]
    private ?AdminLog $_created = null;

    #[ORM\OneToOne(cascade: ['persist'])]
    private ?AdminLog $_updated = null;

    public function __construct()
    {
        $this->logs = new ArrayCollection();
        $this->accesslogs = new ArrayCollection();
        $this->blogArticles = new ArrayCollection();
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
    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, AdminLog>
     */
    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function addLog(AdminLog $log): static
    {
        if (!$this->logs->contains($log)) {
            $this->logs->add($log);
            $log->setUserLogin($this);
        }

        return $this;
    }

    public function removeLog(AdminLog $log): static
    {
        if ($this->logs->removeElement($log)) {
            // set the owning side to null (unless already changed)
            if ($log->getUserLogin() === $this) {
                $log->setUserLogin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AdminAccessLog>
     */
    public function getAccesslogs(): Collection
    {
        return $this->accesslogs;
    }

    public function addAccesslog(AdminAccessLog $accesslog): static
    {
        if (!$this->accesslogs->contains($accesslog)) {
            $this->accesslogs->add($accesslog);
        }

        return $this;
    }

    public function removeAccesslog(AdminAccessLog $accesslog): static
    {
        if ($this->accesslogs->removeElement($accesslog)) {
        }

        return $this;
    }

    /**
     * @return Collection<int, BlogArticle>
     */
    public function getBlogArticles(): Collection
    {
        return $this->blogArticles;
    }

    public function addBlogArticle(BlogArticle $blogArticle): static
    {
        if (!$this->blogArticles->contains($blogArticle)) {
            $this->blogArticles->add($blogArticle);
            $blogArticle->addUser($this);
        }

        return $this;
    }

    public function removeBlogArticle(BlogArticle $blogArticle): static
    {
        if ($this->blogArticles->removeElement($blogArticle)) {
            $blogArticle->removeUser($this);
        }

        return $this;
    }

    public function getRole(): ?AdminUserRole
    {
        return $this->role;
    }

    public function setRole(?AdminUserRole $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function __toString(): string
    {
        return $this->login.' - '.$this->role;
    }


    public function getCreated(): ?AdminLog
    {
        return $this->_created;
    }

    public function setCreated(?AdminLog $_created): static
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

    // User interface

    public function getRoles(): array
    {
        return array($this->role->getCode());
    }

    public function getUserIdentifier(): string
    {
        return $this->login;
    }
    public function eraseCredentials(): void
    {

    }
    public function getSalt():?string 
    {
        return null;
    }
}
