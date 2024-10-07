<?php

namespace App\Entity;

use App\Repository\CertidaoDividaSiatuRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CertidaoDividaSiatuRepository::class)]
class CertidaoDividaSiatu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ContribuinteSiatu $contribuinte_id = null;

    #[ORM\Column]
    private ?float $valor = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $pdfdivida;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descricao = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $data_vencimento = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getContribuinteId(): ?ContribuinteSiatu
    {
        return $this->contribuinte_id;
    }

    public function setContribuinteId(?ContribuinteSiatu $contribuinte_id): static
    {
        $this->contribuinte_id = $contribuinte_id;

        return $this;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): static
    {
        $this->valor = $valor;

        return $this;
    }

    public function getPdfdivida()
    {
        return $this->pdfdivida;
    }

    public function setPdfdivida($pdfdivida): static
    {
        $this->pdfdivida = $pdfdivida;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): static
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getDataVencimento(): ?\DateTimeInterface
    {
        return $this->data_vencimento;
    }

    public function setDataVencimento(?\DateTimeInterface $data_vencimento): static
    {
        $this->data_vencimento = $data_vencimento;

        return $this;
    }
}
