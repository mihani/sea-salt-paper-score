<?php

namespace App\Calculator\CardCalculator;

use App\Dto\Calculator\CalculatorResult;
use App\Dto\Calculator\DetailedPoint;
use App\Dto\PlayerHandDto;

class CardBoostCalculator implements CardCalculatorInterface
{
    public function getPoints(PlayerHandDto $playerHandDto): CalculatorResult
    {
        $result = new CalculatorResult();

        foreach ($playerHandDto->getCardsBoost() as $cardBoost) {
            if (!($boostedCard = $playerHandDto->getBoostedCard($cardBoost->getBoostedCardClassName()))) {
                continue;
            }

            $result->addResult(new DetailedPoint(get_class($cardBoost), $boostedCard->getQuantity() * $cardBoost->getPointByQuantity()));
        }

        return $result;
    }
}
