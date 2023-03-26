<?php

namespace App\Dto;

use App\Dto\Cards\CardBoost\CardBoostDtoInterface;
use App\Dto\Cards\CardWithQuantityDtoInterface;
use App\Dto\Cards\Collection\CollectionCardDtoInterface;
use App\Dto\Cards\Special\MermaidCardDto;

class PlayerHandDto
{
    /**
     * @param CardWithQuantityDtoInterface[] $duoCards
     * @param CollectionCardDtoInterface[]   $collectionCards
     * @param CardBoostDtoInterface[]        $cardsBoost
     */
    public function __construct(
        private array $duoCards = [],
        private array $collectionCards = [],
        private array $cardsBoost = [],
        private MermaidCardDto $mermaidCardDto = new MermaidCardDto(0, [])
    ) {
    }

    public function getDuoCards(): array
    {
        return $this->duoCards;
    }

    public function getCollectionCards(): array
    {
        return $this->collectionCards;
    }

    public function getMermaidCardDto(): MermaidCardDto
    {
        return $this->mermaidCardDto;
    }

    public function getCardsBoost(): array
    {
        return $this->cardsBoost;
    }

    public function getBoostedCard(string $className): ?CardWithQuantityDtoInterface
    {
        foreach (array_merge($this->getCollectionCards(), $this->getDuoCards()) as $card) {
            if (!$card instanceof $className) {
                continue;
            }

            return $card;
        }

        return null;
    }
}
