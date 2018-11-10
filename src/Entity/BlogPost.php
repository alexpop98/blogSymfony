<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogPostRepository")
 */
class BlogPost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $titolo;

    /**
     * @ORM\Column(type="text")
     */
    private $sottotitolo;

    /**
     * @ORM\Column(type="text")
     */
    private $testo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\Column(type="text")
     */
    private $id_autore;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitolo(): ?string
    {
        return $this->titolo;
    }

    public function setTitolo(string $titolo): self
    {
        $this->titolo = $titolo;

        return $this;
    }

    public function getSottotitolo(): ?string
    {
        return $this->sottotitolo;
    }

    public function setSottotitolo(string $sottotitolo): self
    {
        $this->sottotitolo = $sottotitolo;

        return $this;
    }

    public function getTesto(): ?string
    {
        return $this->testo;
    }

    public function setTesto(string $testo): self
    {
        $this->testo = $testo;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getIdAutore(): ?string
    {
        return $this->id_autore;
    }

    public function setIdAutore(string $id_autore): self
    {
        $this->id_autore = $id_autore;

        return $this;
    }
}
