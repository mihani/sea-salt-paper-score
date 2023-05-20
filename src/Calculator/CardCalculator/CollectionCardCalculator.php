<?php

namespace App\Calculator\CardCalculator;

use App\Config\CollectionCard;
use App\Dto\Calculator\CalculatorResult;
use App\Dto\Calculator\EmbedDetailedPoint;
use App\Dto\PlayerHandDto;

class CollectionCardCalculator implements CardCalculatorInterface
{
    public function getPoints(PlayerHandDto $playerHandDto): CalculatorResult
    {
        $result = new CalculatorResult();

        foreach ($playerHandDto->getCollectionCards() as $collectionCard) {
            /** @var CollectionCard $collectionCardEnum */
            $collectionCardEnum = $collectionCard->type;

            $result->addResult(new EmbedDetailedPoint($collectionCardEnum::class, $collectionCard->quantity));
        }

        return $result;
    }

    public function getType(): string
    {
        return CollectionCard::class;
    }
}
