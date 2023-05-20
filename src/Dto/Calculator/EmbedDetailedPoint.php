<?php

namespace App\Dto\Calculator;

readonly class EmbedDetailedPoint implements DetailedPointInterface
{
    public function __construct(
        private string $cardType,
        private int $points = 0
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
