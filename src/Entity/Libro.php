<?php

namespace App\Entity;

use App\Repository\LibroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LibroRepository::class)]
class Libro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $autor = null;

    #[ORM\Column(length: 255)]
    private ?string $sinopsis = null;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $publicacion = null;

    #[ORM\Column(length: 255)]
    private ?string $editorial = null;

    #[ORM\Column(length: 255)]
    private ?string $isbn = null;

    #[ORM\Column]
    private ?int $numero_ejemplares = null;

    #[ORM\ManyToOne(inversedBy: 'libros')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Biblioteca $biblioteca = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): static
    {
        $this->autor = $autor;

        return $this;
    }

    public function getSinopsis(): ?string
    {
        return $this->sinopsis;
    }

    public function setSinopsis(string $sinopsis): static
    {
        $this->sinopsis = $sinopsis;

        return $this;
    }

    public function getPublicacion(): ?\DateTimeInterface
    {
        return $this->publicacion;
    }

    public function setPublicacion(\DateTimeInterface $publicacion): static
    {
        $this->publicacion = $publicacion;

        return $this;
    }

    public function getEditorial(): ?string
    {
        return $this->editorial;
    }

    public function setEditorial(string $editorial): static
    {
        $this->editorial = $editorial;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getNumeroEjemplares(): ?int
    {
        return $this->numero_ejemplares;
    }

    public function setNumeroEjemplares(int $numero_ejemplares): static
    {
        $this->numero_ejemplares = $numero_ejemplares;

        return $this;
    }

    public function getBiblioteca(): ?Biblioteca
    {
        return $this->biblioteca;
    }

    public function setBiblioteca(?Biblioteca $biblioteca): static
    {
        $this->biblioteca = $biblioteca;

        return $this;
    }
}
