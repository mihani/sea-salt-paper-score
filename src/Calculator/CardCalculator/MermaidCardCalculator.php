<?php

namespace App\Calculator\CardCalculator;

use App\Dto\Calculator\CalculatorResult;
use App\Dto\Calculator\DetailedPoint;
use App\Dto\Cards\Special\MermaidCardDto;
use App\Dto\PlayerHandDto;

class MermaidCardCalculator implements CardCalculatorInterface
{
    public function getPoints(PlayerHandDto $playerHandDto): CalculatorResult
    {
        $result = new CalculatorResult();

        $mermaidCardDto = $playerHandDto->getMermaidCardDto();
        $quantityOfMermaid = $mermaidCardDto->getQuantity();

        if (0 === $quantityOfMermaid) {
            return $result;
        }

        $quantityByColor = $mermaidCardDto->getQuantityByColor();
        arsort($quantityByColor);

        $highestColorSuits = array_slice($quantityByColor, 0, $quantityOfMermaid);

        foreach ($highestColorSuits as $index => $highestColorSuit) {
            $result->addResult(new DetailedPoint(MermaidCardDto::class.'-'.$index, $highestColorSuit));
        }

        return $result;
    }
}
