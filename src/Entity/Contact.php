<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom ne peut pas être vide.")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="L'adresse email '{{ value }}' n'est pas valide.")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le numéro de téléphone ne peut pas être vide.")
     * @Assert\Regex(
     *     pattern="/^0[1-9][0-9]{8}$/",
     *     message="Veuillez entrer un numéro de téléphone valide (10 chiffres)."
     * )
     */
    private $phone;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le nombre de pièces ne peut pas être vide.")
     */
    private $pieces;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le nombre de m² ne peut pas être vide.")
     * @Assert\Positive(message="Le nombre de m² doit être positif.")
     */
    private $m2;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le type d'habitation ne peut pas être vide.")
     */
    private $habitation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le statut de foyer ne peut pas être vide.")
     */
    private $foyer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $styles;  // Modification ici, champ de type string pour un seul choix

    /**
     * @ORM\Column(type="text", nullable=true)
     */

    private $formule;

    /**
     * @ORM\Column (type="text" , nullable=true)
     */

    private $rappel;

    /**
     * @ORM\Column (type="text" , nullable=true)
     */

    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPieces(): ?int
    {
        return $this->pieces;
    }

    public function setPieces(int $pieces): self
    {
        $this->pieces = $pieces;

        return $this;
    }

    public function getM2(): ?int
    {
        return $this->m2;
    }

    public function setM2(int $m2): self
    {
        $this->m2 = $m2;

        return $this;
    }

    public function getHabitation(): ?string
    {
        return $this->habitation;
    }

    public function setHabitation(string $habitation): self
    {
        $this->habitation = $habitation;

        return $this;
    }

    public function getFoyer(): ?string
    {
        return $this->foyer;
    }

    public function setFoyer(string $foyer): self
    {
        $this->foyer = $foyer;

        return $this;
    }

    public function getStyles(): ?string
    {
        return $this->styles;
    }

    public function setStyles(?string $styles): self
    {
        $this->styles = $styles;

        return $this;
    }

    public function getFormule(): ?string
    {
        return $this->formule;
    }
    public function setFormule(?string $formule): self
    {
        $this->formule = $formule;
        return $this;
    }


    public function getRappel(): ?string
    {
        return $this->rappel;
    }

    public function setRappel(?string $rappel): self
    {
        $this->rappel = $rappel;
        return $this;
    }
    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
