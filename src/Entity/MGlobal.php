<?php

namespace App\Entity;

use App\Repository\MGlobalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MGlobalRepository::class)
 */
class MGlobal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\OneToMany(targetEntity=Aime::class, mappedBy="mGlobal")
     */
    private $Aime;

    public function __construct()
    {
        $this->Aime = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return Collection|Aime[]
     */
    public function getAime(): Collection
    {
        return $this->Aime;
    }

    public function addAime(Aime $aime): self
    {
        if (!$this->Aime->contains($aime)) {
            $this->Aime[] = $aime;
            $aime->setMGlobal($this);
        }

        return $this;
    }

    public function removeAime(Aime $aime): self
    {
        if ($this->Aime->contains($aime)) {
            $this->Aime->removeElement($aime);
            // set the owning side to null (unless already changed)
            if ($aime->getMGlobal() === $this) {
                $aime->setMGlobal(null);
            }
        }

        return $this;
    }
}
