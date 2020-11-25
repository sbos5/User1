<?php

namespace App\Entity;

use App\Repository\DomRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
/**
 * @ORM\Entity(repositoryClass=DomRepository::class)
 */
class Dom 
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
    private $model;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $data;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getData(): ?\DateTime
    {
        return $this->data;
    }

    public function setData(?\DateTime $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function __wakeup(): void {
        
    }

    public function diff(DateTime $datetime2, bool $absolute = FALSE): \DateInterval {
        
    }

    public function format(DateTime $format)
    {
       return date(); 
    }

    public function getOffset(): int {
        
    }

    public function getTimestamp(): int {
        
    }

    public function getTimezone(): \DateTimeZone {
        
    }

}
