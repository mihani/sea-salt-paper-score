<?php

namespace App\Dto;

use App\Config\BoostCard;
use App\Dto\Cards\BoostCardDto;
use App\Dto\Cards\CollectionCardDto;
use App\Dto\Cards\DuoCardDto;
use App\Dto\Cards\MermaidCardDto;

class PlayerHandDto
{
    /**
     * @param DuoCardDto[]        $duoCards
     * @param CollectionCardDto[] $collectionCards
     * @param BoostCardDto[]      $boostCards
     * @param MermaidCardDto[]    $mermaidCards
     */
    public function __construct(
        private array $duoCards = [],
        private array $collectionCards = [],
        private array $boostCards = [],
        private array $mermaidCards = []
    ) {
    }

    public function getDuoCards(): array
    {
        return $this->duoCards;
    }

    public function setDuoCards(array $duoCards): self
    {
        $this->duoCards = $duoCards;

        return $this;
    }

    public function getCollectionCards(): array
    {
        return $this->collectionCards;
    }

    public function setCollectionCards(array $collectionCards): self
    {
        $this->collectionCards = $collectionCards;

        return $this;
    }

    public function getMermaidCards(): array
    {
        return $this->mermaidCards;
    }

    public function setMermaidCards(array $mermaidCards): self
    {
        $this->mermaidCards = $mermaidCards;

        return $this;
    }

    public function getBoostCards(): array
    {
        return $this->boostCards;
    }

    public function setBoostCards(array $boostCards): self
    {
        $this->boostCards = $boostCards;

        return $this;
    }

    public function getBoostedCard(BoostCard $boostCard): CollectionCardDto|DuoCardDto|null
    {
        foreach (array_merge($this->getCollectionCards(), $this->getDuoCards()) as $card) {
            if ($card->type->getBooster() !== $boostCard) {
                continue;
            }

            return $card;
        }

        return null;
    }
}
