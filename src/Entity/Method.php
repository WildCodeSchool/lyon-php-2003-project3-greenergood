<?php

namespace App\Entity;

use App\Repository\MethodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MethodRepository", repositoryClass=MethodRepository::class)
 */
class Method
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide")
     * @Assert\Length(max="255", maxMessage="Le nom ne devrait pas dépasser {{ limit }} caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide")
     */
    private $prerequisites;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Ce champ ne doit pas être vide")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $objectives;

    /**
     * @ORM\OneToMany(
     *     targetEntity=MethodLink::class,
     *     mappedBy="method",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     *     )
     * @Assert\Valid()
     */
    private $methodLinks;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activated = true;

    public function __construct()
    {
        $this->methodLinks = new ArrayCollection();
    }

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPrerequisites(): ?string
    {
        return $this->prerequisites;
    }

    public function setPrerequisites(string $prerequisites): self
    {
        $this->prerequisites = $prerequisites;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getObjectives(): ?string
    {
        return $this->objectives;
    }

    public function setObjectives(?string $objectives): self
    {
        $this->objectives = $objectives;

        return $this;
    }

    /**
     * @return Collection|MethodLink[]
     */
    public function getMethodLinks(): Collection
    {
        return $this->methodLinks;
    }

    public function addMethodLink(MethodLink $methodLink): self
    {
        if (!$this->methodLinks->contains($methodLink)) {
            $this->methodLinks[] = $methodLink;
            $methodLink->setMethod($this);
        }

        return $this;
    }

    public function removeMethodLink(MethodLink $methodLink): self
    {
        if ($this->methodLinks->contains($methodLink)) {
            $this->methodLinks->removeElement($methodLink);
            // set the owning side to null (unless already changed)
            if ($methodLink->getMethod() === $this) {
                $methodLink->setMethod(null);
            }
        }

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

    public function clone(): Method
    {
        $method = new Method();
        $method->setName($this->getName());
        $method->setCreatedAt(new DateTime('now'));
        $method->setPrerequisites($this->getPrerequisites());
        $method->setContent($this->getContent());
        $method->setObjectives($this->getObjectives());

        foreach ($this->getMethodLinks() as $methodLink)
        {
            $method->addMethodLink(clone $methodLink);
        }

        return $method;
    }
}
