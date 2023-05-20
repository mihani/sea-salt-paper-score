<?php

namespace App\Dto\Calculator;

readonly class DetailedPoint implements DetailedPointInterface
{
    public function __construct(
        private string $type,
        private CalculatorResult $calculatorResult
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
