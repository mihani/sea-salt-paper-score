<?php

namespace App\Dto\Calculator;

class EmbedDetailedPoint implements DetailedPointInterface
{
    public function __construct(
        private readonly string $type,
        private readonly CalculatorResult $calculatorResult
    ) {
    }

    public function getPoints(): int
    {
        return $this->calculatorResult->getPoints();
    }

    public function getCardType(): string
    {
        return $this->type;
    }

    public function getDetailedPoints(): array
    {
        return $this->calculatorResult->getDetailedPoints();
    }
}
