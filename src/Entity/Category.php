<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Name;

    /**
     * @ORM\OneToMany(targetEntity=Method::class, mappedBy="category", orphanRemoval=true)
     */
    private $method;

    public function __construct()
    {
        $this->method = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $name): self
    {
        $this->Name = $name;

        return $this;
    }

    /**
     * @return Collection|Method[]
     */
    public function getMethod(): Collection
    {
        return $this->method;
    }

    public function addMethod(Method $method): self
    {
        if (!$this->method->contains($method)) {
            $this->method[] = $method;
            $method->setCategory($this);
        }

        return $this;
    }

    public function removeMethod(Method $method): self
    {
        if ($this->method->contains($method)) {
            $this->method->removeElement($method);
            // set the owning side to null (unless already changed)
            if ($method->getCategory() === $this) {
                $method->setCategory(null);
            }
        }

        return $this;
    }
}
