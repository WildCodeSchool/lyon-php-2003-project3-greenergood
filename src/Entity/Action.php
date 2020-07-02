<?php

namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Positive(message="Le numéro d'édition doit être supérieur à 0")
     */
    private $editionNumber;

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
     *     choices = { "started", "ended", "cancelled" }
     * )
     */
    private $status = 'En cours';

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $projectProgress;

    /**

     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="action")
     */
    private $teams;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
      $this->methods = new ArrayCollection();
        $this->actionDeliverable = new ArrayCollection();
          
     * Used for soft delete of action pages
     * @ORM\Column(type="boolean")
     */
    private $activated = true;

    /**
     * @ORM\ManyToMany(targetEntity=Method::class)
     */
    private $methods;
  
     /**
     * @ORM\OneToMany(
     *     targetEntity=ActionDeliverable::class,
     *     mappedBy="action",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     *     )
     * @Assert\Valid()
     */
    private $actionDeliverable;

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

    public function getActivated(): ?bool
    {
        return $this->activated;
    }

    public function setActivated(bool $activated): self
    {
        $this->activated = $activated;

        return $this;
    }

    /**
     * @return Collection|Method[]
     */
    public function getMethods(): Collection
    {
        return $this->methods;
    }

    public function addMethod(Method $method): self
    {
        if (!$this->methods->contains($method)) {
            $this->methods[] = $method;
        }

        return $this;
    }
  
    public function removeMethod(Method $method): self
    {
        if ($this->methods->contains($method)) {
            $this->methods->removeElement($method);
        }

        return $this;
    }
      
     /**
     * @return Collection|ActionDeliverable[]
     */
    public function getActionDeliverable(): Collection
    {
        return $this->actionDeliverable;
    }

    public function addActionDeliverable(ActionDeliverable $actionDeliverable): self
    {
        if (!$this->actionDeliverable->contains($actionDeliverable)) {
            $this->actionDeliverable[] = $actionDeliverable;
            $actionDeliverable->setAction($this);
        }

        return $this;
    }

    public function removeActionDeliverable(ActionDeliverable $actionDeliverable): self
    {
        if ($this->actionDeliverable->contains($actionDeliverable)) {
            $this->actionDeliverable->removeElement($actionDeliverable);
            // set the owning side to null (unless already changed)
            if ($actionDeliverable->getAction() === $this) {
                $actionDeliverable->setAction(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->setAction($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            // set the owning side to null (unless already changed)
            if ($team->getAction() === $this) {
                $team->setAction(null);
            }
        }

        return $this;
    }
}
