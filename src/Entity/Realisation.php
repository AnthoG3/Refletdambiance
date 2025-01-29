<?php

namespace App\Entity;

use App\Repository\RealisationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RealisationRepository::class)]
class Realisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    #[ORM\ManyToOne(targetEntity: Formule::class)]
    #[ORM\JoinColumn(name: 'formule_id', referencedColumnName: 'id')]
    private ?Formule $formule = null;

    #[ORM\ManyToMany(targetEntity: Inspiration::class)]
    #[ORM\JoinTable(name: 'realisation_inspiration')] // Table de jonction
    #[ORM\JoinColumn(name: 'realisation_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'inspiration_id', referencedColumnName: 'id')]
    private ?\Doctrine\Common\Collections\Collection $inspirations = null;

    public function __construct()
    {
        $this->inspirations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;
        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getInspirations(): \Doctrine\Common\Collections\Collection
    {
        return $this->inspirations;
    }

    public function addInspiration(Inspiration $inspiration): static
    {
        if (!$this->inspirations->contains($inspiration)) {
            $this->inspirations[] = $inspiration;
        }

        return $this;
    }

    public function removeInspiration(Inspiration $inspiration): static
    {
        $this->inspirations->removeElement($inspiration);

        return $this;
    }

    public function getFormule(): ?Formule
    {
        return $this->formule;
    }

    public function setFormule(?Formule $formule): static
    {
        $this->formule = $formule;
        return $this;
    }
}