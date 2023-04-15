<?php

namespace App\Dto\Calculator;

class DetailedPoint implements DetailedPointInterface
{
    public function __construct(
        private readonly string $cardType,
        private readonly int $points = 0
    ) {
    }

    public function getCardType(): string
    {
        return $this->cardType;
    }

    public function getPoints(): int
    {
        return $this->points;
    }
}
