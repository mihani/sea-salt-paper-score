<?php

namespace App\Calculator\CardCalculator;

use App\Dto\Calculator\CalculatorResult;
use App\Dto\Calculator\DetailedPoint;
use App\Dto\PlayerHandDto;

class DuoCardCalculator implements CardCalculatorInterface
{
    public function getPoints(PlayerHandDto $playerHandDto): CalculatorResult
    {
        $result = new CalculatorResult();

        foreach ($playerHandDto->getDuoCards() as $duoCard) {
            $result->addResult(new DetailedPoint(get_class($duoCard), (int) ($duoCard->getQuantity() / 2)));
        }

        return $result;
    }
}
