<?php

namespace App\Calculator\CardCalculator;

use App\Dto\PlayerHandDto;

class MermaidCardCalculator implements CardCalculatorInterface
{
    public function getPoints(PlayerHandDto $playerHandDto): int
    {
        $mermaidCardDto = $playerHandDto->getMermaidCardDto();
        $quantityOfMermaid = $mermaidCardDto->getQuantity();

        if (0 === $quantityOfMermaid) {
            return 0;
        }

        $quantityByColor = $mermaidCardDto->getQuantityByColor();
        arsort($quantityByColor);

        $highestColorSuits = array_slice($quantityByColor, 0, $quantityOfMermaid);

        return (int) array_sum($highestColorSuits);
    }
}
