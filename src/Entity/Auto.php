<?php

namespace App\Entity;

use App\Repository\AutoRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
/**
 * @ORM\Entity(repositoryClass=AutoRepository::class)
 */
class Auto 

{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marka;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $rok_prod;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    public function getId(): ?int
    {
        return $this->id;
    }
     public function setId(int $id): ?int
    {
      $this->id=$id;
        return $this->id;
    }

    public function getMarka(): ?string
    {
        return $this->marka;
    }

    public function setMarka(?string $marka): self
    {
        $this->marka = $marka;

        return $this;
    }
    
    public function getRok_prod(): ?\DateTime
    {
        return $this->rok_prod;
    }
     public function getRokprod(): ?\DateTime
    {
        return $this->rok_prod;
    }

    public function setRok_prod(?\DateTime $rok_prod): self
    {
        $this->rok_prod = $rok_prod;

        return $this;
    }
    public function setRokprod(?\DateTime $rok_prod): self
    {
        $this->rok_prod = $rok_prod;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    
}
