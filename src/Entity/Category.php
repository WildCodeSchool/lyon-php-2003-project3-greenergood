<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Length(max="100", maxMessage="Ce champ est trop long", allowEmptyString="false")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Method::class, mappedBy="category")
     */
    private $methods;

    public function __construct()
    {
        $this->methods = new ArrayCollection();
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

    /**
     * @return Collection|Method[]
     */
    public function getMethod(): Collection
    {
        return $this->methods;
    }

    public function addMethod(Method $methods): self
    {
        if (!$this->methods->contains($methods)) {
            $this->methods[] = $methods;
            $methods->setCategory($this);
        }

        return $this;
    }

    public function removeMethod(Method $methods): self
    {
        if ($this->methods->contains($methods)) {
            $this->methods->removeElement($methods);
            // set the owning side to null (unless already changed)
            if ($methods->getCategory() === $this) {
                $methods->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Method[]
     */
    public function getMethods(): Collection
    {
        return $this->methods;
    }
}
