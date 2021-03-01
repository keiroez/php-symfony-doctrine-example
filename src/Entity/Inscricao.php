<?php

namespace App\Entity;

use App\Repository\InscricaoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=InscricaoRepository::class)
 */
class Inscricao
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank(message="Preencha o campo do nome!")
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Preencha o campo do sobrenome!")
     */
    private $sobrenome;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Preencha o compo da idade!")
     * @Assert\Range(min="18", minMessage="Idade deve ser maior que 18 anos!")
     */
    private $idade;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Email(message="E-mail inválido!")
     * @Assert\NotBlank(message="Preencha o campo do e-mail!")
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getSobrenome(): ?string
    {
        return $this->sobrenome;
    }

    public function setSobrenome(string $sobrenome): self
    {
        $this->sobrenome = $sobrenome;

        return $this;
    }

    public function getIdade(): ?int
    {
        return $this->idade;
    }

    public function setIdade(int $idade): self
    {
        $this->idade = $idade;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
