<?php

namespace App\Entity;

use App\Repository\CertidaoDividaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CertidaoDividaRepository::class)]
class CertidaoDivida
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $value = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_payment = null;

    #[ORM\ManyToOne(inversedBy: 'certidaoDividas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contribuinte $contribuinte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getDatePayment(): ?\DateTimeInterface
    {
        return $this->date_payment;
    }

    public function setDatePayment(?\DateTimeInterface $date_payment): static
    {
        $this->date_payment = $date_payment;

        return $this;
    }

    public function getContribuinte(): ?Contribuinte
    {
        return $this->contribuinte;
    }

    public function setContribuinte(?Contribuinte $contribuinte): static
    {
        $this->contribuinte = $contribuinte;

        return $this;
    }
}
