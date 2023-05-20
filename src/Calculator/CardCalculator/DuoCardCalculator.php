<?php

namespace App\Calculator\CardCalculator;

use App\Config\DuoCard;
use App\Dto\Calculator\CalculatorResult;
use App\Dto\Calculator\EmbedDetailedPoint;
use App\Dto\PlayerHandDto;

class DuoCardCalculator implements CardCalculatorInterface
{
    public function getPoints(PlayerHandDto $playerHandDto): CalculatorResult
    {
        $result = new CalculatorResult();

        foreach ($playerHandDto->getDuoCards() as $duoCard) {
            /** @var DuoCard $duoCardEnum */
            $duoCardEnum = $duoCard->type;

            $result->addResult(new EmbedDetailedPoint($duoCardEnum::class, (int) ($duoCard->quantity / 2)));
        }

        return $result;
    }

    public function getType(): string
    {
        return DuoCard::class;
    }
}
