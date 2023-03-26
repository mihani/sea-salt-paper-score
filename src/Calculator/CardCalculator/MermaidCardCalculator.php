<?php

namespace App\Calculator\CardCalculator;

use App\Dto\PlayerHandDto;

readonly class MermaidCardCalculator implements CardCalculatorInterface
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

        return array_reduce(array_slice($quantityByColor, 0, $quantityOfMermaid), function (int $sum, int $count) {
            return $sum + $count;
        }, 0);
    }
}
