<?php

namespace App\Calculator\CardCalculator;

use App\Config\BoostCard;
use App\Dto\Calculator\CalculatorResult;
use App\Dto\Calculator\EmbedDetailedPoint;
use App\Dto\PlayerHandDto;

class CardBoostCalculator implements CardCalculatorInterface
{
    public function getPoints(PlayerHandDto $playerHandDto): CalculatorResult
    {
        $result = new CalculatorResult();

        foreach ($playerHandDto->getBoostCards() as $cardBoost) {
            /** @var BoostCard $boostCardEnum */
            $boostCardEnum = $cardBoost->type;
            if (!($boostedCard = $playerHandDto->getBoostedCard($boostCardEnum))) {
                continue;
            }

            $result->addResult(new EmbedDetailedPoint($boostCardEnum::class, $boostedCard->quantity * $boostCardEnum->point()));
        }

        return $result;
    }

    public function getType(): string
    {
        return BoostCard::class;
    }
}
