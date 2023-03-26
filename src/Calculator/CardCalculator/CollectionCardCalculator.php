<?php

namespace App\Calculator\CardCalculator;

use App\Dto\PlayerHandDto;

readonly class CollectionCardCalculator implements CardCalculatorInterface
{
    public function getPoints(PlayerHandDto $playerHandDto): int
    {
        $points = 0;

        foreach ($playerHandDto->getCollectionCards() as $collectionCard) {
            $points += $collectionCard->getPoints();
        }

        return $points;
    }
}
