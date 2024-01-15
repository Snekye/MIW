<?php

namespace App\Entity;

use App\Repository\AdminLogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminLogRepository::class)]
class AdminLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'logs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?adminuser $user_login = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $cible_table = null;

    #[ORM\Column]
    private ?int $cible_id = null;

    #[ORM\Column(length: 255)]
    private ?string $action = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUserLogin(): ?adminuser
    {
        return $this->user_login;
    }

    public function setUserLogin(?adminuser $user_login): static
    {
        $this->user_login = $user_login;

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

    public function getCibleTable(): ?string
    {
        return $this->cible_table;
    }

    public function setCibleTable(string $cible_table): static
    {
        $this->cible_table = $cible_table;

        return $this;
    }

    public function getCibleId(): ?int
    {
        return $this->cible_id;
    }

    public function setCibleId(int $cible_id): static
    {
        $this->cible_id = $cible_id;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): static
    {
        $this->action = $action;

        return $this;
    }
}
