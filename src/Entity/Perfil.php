<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PerfilRepository")
 */
class Perfil
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idperfil;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $area;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $cargo;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $celular;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $foto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="perfiles")
     */
    private $usuario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdperfil(): ?int
    {
        return $this->idperfil;
    }

    public function setIdperfil(?int $idperfil): self
    {
        $this->idperfil = $idperfil;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(?string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(?string $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(?string $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}
