<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=User::class)
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity=Method::class)
     */
    private $methods;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->methods = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
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
}
