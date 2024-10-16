<?php

namespace App\Entity;

use App\Repository\ContribuinteSuppRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContribuinteSuppRepository::class)]
class ContribuinteSupp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\Column(length: 255)]
    private ?string $cpf = null;

    #[ORM\Column(length: 255)]
    private ?string $endereco = null;

    /**
     * @var Collection<int, CertidaoDividaSupp>
     */
    #[ORM\OneToMany(targetEntity: CertidaoDividaSupp::class, mappedBy: 'contribuinte_supp')]
    private Collection $certidaoDividaSupps;

    public function __construct()
    {
        $this->certidaoDividaSupps = new ArrayCollection();
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

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

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

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): static
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * @return Collection<int, CertidaoDividaSupp>
     */
    public function getCertidaoDividaSupps(): Collection
    {
        return $this->certidaoDividaSupps;
    }

    public function addCertidaoDividaSupp(CertidaoDividaSupp $certidaoDividaSupp): static
    {
        if (!$this->certidaoDividaSupps->contains($certidaoDividaSupp)) {
            $this->certidaoDividaSupps->add($certidaoDividaSupp);
            $certidaoDividaSupp->setContribuinteSupp($this);
        }

        return $this;
    }

    public function removeCertidaoDividaSupp(CertidaoDividaSupp $certidaoDividaSupp): static
    {
        if ($this->certidaoDividaSupps->removeElement($certidaoDividaSupp)) {
            // set the owning side to null (unless already changed)
            if ($certidaoDividaSupp->getContribuinteSupp() === $this) {
                $certidaoDividaSupp->setContribuinteSupp(null);
            }
        }

        return $this;
    }
}
