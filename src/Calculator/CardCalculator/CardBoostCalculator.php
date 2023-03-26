<?php

namespace App\Calculator\CardCalculator;

use App\Dto\PlayerHandDto;

readonly class CardBoostCalculator implements CardCalculatorInterface
{
    public function getPoints(PlayerHandDto $playerHandDto): int
    {
        $points = 0;

        foreach ($playerHandDto->getCardsBoost() as $cardBoost) {
            if (!($boostedCard = $playerHandDto->getBoostedCards($cardBoost->getBoostedCardClassName()))) {
                continue;
            }

            $points += $boostedCard->getQuantity() * $cardBoost->getPointByQuantity();
        }

        return $points;
    }
}
