<?php

namespace App\Entity;

use App\Repository\ContribuinteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContribuinteRepository::class)]
class Contribuinte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 20)]
    private ?string $cpf = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    /**
     * @var Collection<int, CertidaoDivida>
     */
    #[ORM\OneToMany(targetEntity: CertidaoDivida::class, mappedBy: 'contribuinte')]
    private Collection $certidaoDividas;

    public function __construct()
    {
        $this->certidaoDividas = new ArrayCollection();
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

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): static
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return Collection<int, CertidaoDivida>
     */
    public function getCertidaoDividas(): Collection
    {
        return $this->certidaoDividas;
    }

    public function addCertidaoDivida(CertidaoDivida $certidaoDivida): static
    {
        if (!$this->certidaoDividas->contains($certidaoDivida)) {
            $this->certidaoDividas->add($certidaoDivida);
            $certidaoDivida->setContribuinte($this);
        }

        return $this;
    }

    public function removeCertidaoDivida(CertidaoDivida $certidaoDivida): static
    {
        if ($this->certidaoDividas->removeElement($certidaoDivida)) {
            // set the owning side to null (unless already changed)
            if ($certidaoDivida->getContribuinte() === $this) {
                $certidaoDivida->setContribuinte(null);
            }
        }

        return $this;
    }
}
