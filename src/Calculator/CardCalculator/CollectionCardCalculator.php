<?php

namespace App\Calculator\CardCalculator;

use App\Dto\Calculator\CalculatorResult;
use App\Dto\Calculator\DetailedPoint;
use App\Dto\PlayerHandDto;

class CollectionCardCalculator implements CardCalculatorInterface
{
    public function getPoints(PlayerHandDto $playerHandDto): CalculatorResult
    {
        $result = new CalculatorResult();

        foreach ($playerHandDto->getCollectionCards() as $collectionCard) {
            $result->addResult(new DetailedPoint(get_class($collectionCard), $collectionCard->getPoints()));
        }

        return $result;
    }
}
