<?php

namespace App\Entity;

use App\Repository\BibliotecaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BibliotecaRepository::class)]
class Biblioteca
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $direccion = null;

    #[ORM\Column(length: 255)]
    private ?string $ciudad = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $horario_apertura = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $horario_cierre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_fundacion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $normas = null;

    /**
     * @var Collection<int, Libro>
     */
    #[ORM\OneToMany(targetEntity: Libro::class, mappedBy: 'biblioteca', orphanRemoval: true)]
    private Collection $libros;

    public function __construct()
    {
        $this->libros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): static
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getCiudad(): ?string
    {
        return $this->ciudad;
    }

    public function setCiudad(string $ciudad): static
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    public function getHorarioApertura(): ?\DateTimeInterface
    {
        return $this->horario_apertura;
    }

    public function setHorarioApertura(\DateTimeInterface $horario_apertura): static
    {
        $this->horario_apertura = $horario_apertura;

        return $this;
    }

    public function getHorarioCierre(): ?\DateTimeInterface
    {
        return $this->horario_cierre;
    }

    public function setHorarioCierre(\DateTimeInterface $horario_cierre): static
    {
        $this->horario_cierre = $horario_cierre;

        return $this;
    }

    public function getFechaFundacion(): ?\DateTimeInterface
    {
        return $this->fecha_fundacion;
    }

    public function setFechaFundacion(\DateTimeInterface $fecha_fundacion): static
    {
        $this->fecha_fundacion = $fecha_fundacion;

        return $this;
    }

    public function getNormas(): ?string
    {
        return $this->normas;
    }

    public function setNormas(?string $normas): static
    {
        $this->normas = $normas;

        return $this;
    }

    /**
     * @return Collection<int, Libro>
     */
    public function getLibros(): Collection
    {
        return $this->libros;
    }

    public function addLibro(Libro $libro): static
    {
        if (!$this->libros->contains($libro)) {
            $this->libros->add($libro);
            $libro->setBiblioteca($this);
        }

        return $this;
    }

    public function removeLibro(Libro $libro): static
    {
        if ($this->libros->removeElement($libro)) {
            // set the owning side to null (unless already changed)
            if ($libro->getBiblioteca() === $this) {
                $libro->setBiblioteca(null);
            }
        }

        return $this;
    }
}
