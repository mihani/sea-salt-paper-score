<?php

namespace App\Calculator\CardCalculator;

use App\Config\SpecialCard;
use App\Dto\Calculator\CalculatorResult;
use App\Dto\Calculator\EmbedDetailedPoint;
use App\Dto\Cards\MermaidCardDto;
use App\Dto\PlayerHandDto;

class MermaidCardCalculator implements CardCalculatorInterface
{
    public function getPoints(PlayerHandDto $playerHandDto): CalculatorResult
    {
        $result = new CalculatorResult();

        $mermaidCardDtos = $playerHandDto->getMermaidCards();
        $quantityOfMermaid = count($mermaidCardDtos);

        if (0 === $quantityOfMermaid) {
            return $result;
        }

        foreach ($mermaidCardDtos as $mermaidCardDto) {
            $result->addResult(new EmbedDetailedPoint(MermaidCardDto::class, $mermaidCardDto->quantity));
        }

        return $result;
    }

    public function getType(): string
    {
        return SpecialCard::class;
    }
}
