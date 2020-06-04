<?php

namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ActionRepository::class)
 */
class Action
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom ne devrait pas être vide")
     * @Assert\Length(max="255", maxMessage="Le nom ne devrait pas dépasser {{ limit }} caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull(message="Le numéro d'édition ne devrait pas être nul",)
     */
    private $editionNumber;

    /**
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Positive()
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     max="255",
     *     maxMessage="Le lien ne devrait pas dépasser {{ limit }} caractères",
     * )
     */
    private $actionPicture;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="La description ne devrait pas être vide")
     * @Assert\Length(max="255", maxMessage="La description ne devrait pas dépasser {{ limit }} caractères")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max="255",
     *     maxMessage="Le lieu ne devrait pas dépasser {{ limit }} caractères",
     * )
     */
    private $location;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Choice(
     *     choices = { "En cours", "Terminé", "Annulé" }
     * )
     */
    private $status = 'En cours';

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $projectProgress;

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

    public function getEditionNumber(): ?int
    {
        return $this->editionNumber;
    }

    public function setEditionNumber(int $editionNumber): self
    {
        $this->editionNumber = $editionNumber;

        return $this;
    }

    public function getActionPicture(): ?string
    {
        return $this->actionPicture;
    }

    public function setActionPicture(?string $actionPicture): self
    {
        $this->actionPicture = $actionPicture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getProjectProgress(): ?string
    {
        return $this->projectProgress;
    }

    public function setProjectProgress(?string $projectProgress): self
    {
        $this->projectProgress = $projectProgress;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }
}
