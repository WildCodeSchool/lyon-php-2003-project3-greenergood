<?php

namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\ORM\Mapping as ORM;

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
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $editNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $actionPicture;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $area;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textarea;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $status;

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

    public function getEditNumber(): ?int
    {
        return $this->editNumber;
    }

    public function setEditNumber(int $editNumber): self
    {
        $this->editNumber = $editNumber;

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

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(?string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getTextarea(): ?string
    {
        return $this->textarea;
    }

    public function setTextarea(?string $textarea): self
    {
        $this->textarea = $textarea;

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
}
