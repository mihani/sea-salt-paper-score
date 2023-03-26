<?php

namespace App\Calculator\CardCalculator;

use App\Dto\PlayerHandDto;

class DuoCardCalculator implements CardCalculatorInterface
{
    public function getPoints(PlayerHandDto $playerHandDto): int
    {
        $points = 0;

        foreach ($playerHandDto->getDuoCards() as $duoCard) {
            $points += (int) ($duoCard->getQuantity() / 2);
        }

        return $points;
    }
}
