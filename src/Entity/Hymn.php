<?php

namespace App\Entity;

use App\Repository\HymnRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HymnRepository::class)]
class Hymn
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $HymnNum = null;

    #[ORM\Column(length: 50)]
    private ?string $HymnTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $HymnText = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $ScorePageCount = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $ListID1 = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $ListID2 = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $HymnInfo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHymnNum(): ?int
    {
        return $this->HymnNum;
    }

    public function setHymnNum(int $HymnNum): self
    {
        $this->HymnNum = $HymnNum;

        return $this;
    }

    public function getHymnTitle(): ?string
    {
        return $this->HymnTitle;
    }

    public function setHymnTitle(string $HymnTitle): self
    {
        $this->HymnTitle = $HymnTitle;

        return $this;
    }

    public function getHymnText(): ?string
    {
        return $this->HymnText;
    }

    public function setHymnText(string $HymnText): self
    {
        $this->HymnText = $HymnText;

        return $this;
    }

    public function getScorePageCount(): ?int
    {
        return $this->ScorePageCount;
    }

    public function setScorePageCount(int $ScorePageCount): self
    {
        $this->ScorePageCount = $ScorePageCount;

        return $this;
    }

    public function getListID1(): ?string
    {
        return $this->ListID1;
    }

    public function setListID1(?string $ListID1): self
    {
        $this->ListID1 = $ListID1;

        return $this;
    }

    public function getListID2(): ?string
    {
        return $this->ListID2;
    }

    public function setListID2(?string $ListID2): self
    {
        $this->ListID2 = $ListID2;

        return $this;
    }

    public function getHymnInfo(): ?string
    {
        return $this->HymnInfo;
    }

    public function setHymnInfo(string $HymnInfo): self
    {
        $this->HymnInfo = $HymnInfo;

        return $this;
    }
}
