<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\OperatorRepository;

#[ORM\Entity(repositoryClass: OperatorRepository::class)]
#[ApiResource()]
class Operator extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->roles[] = "ROLE_OPERATOR";
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
