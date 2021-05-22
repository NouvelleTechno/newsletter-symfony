<?php

namespace App\Entity\Newsletters;

use App\Repository\Newsletters\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Users::class, mappedBy="categories")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Newsletters::class, mappedBy="categories", orphanRemoval=true)
     */
    private $newsletters;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->newsletters = new ArrayCollection();
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
     * @return Collection|Users[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addCategory($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if($this->users->removeElement($user)){
            $user->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection|Newsletters[]
     */
    public function getNewsletters(): Collection
    {
        return $this->newsletters;
    }

    public function addNewsletter(Newsletters $newsletter): self
    {
        if (!$this->newsletters->contains($newsletter)) {
            $this->newsletters[] = $newsletter;
            $newsletter->setCategories($this);
        }

        return $this;
    }

    public function removeNewsletter(Newsletters $newsletter): self
    {
        if ($this->newsletters->removeElement($newsletter)) {
            // set the owning side to null (unless already changed)
            if ($newsletter->getCategories() === $this) {
                $newsletter->setCategories(null);
            }
        }

        return $this;
    }
}
