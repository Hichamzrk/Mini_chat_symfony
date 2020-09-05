<?php

namespace App\Entity;

use App\Repository\AimeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=AimeRepository::class)
 * @UniqueEntity(fields={"mGlobal"}, groups={"Aime"})
 */
class Aime
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=MGlobal::class, inversedBy="Aime")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mGlobal;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="aimes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;


    public function getMessageId(): ?MGlobal
    {
        return $this->messageId;
    }

    public function setMessageIdId(?MGlobal $messageId): self
    {
        $this->messageId = $messageId;

        return $this;
    }

    public function getMGlobal(): ?MGlobal
    {
        return $this->mGlobal;
    }

    public function setMGlobal(?MGlobal $mGlobal): self
    {
        $this->mGlobal = $mGlobal;

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
}
