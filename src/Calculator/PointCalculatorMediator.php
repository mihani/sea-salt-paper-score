<?php

namespace App\Calculator;

use App\Calculator\CardCalculator\CardCalculatorInterface;
use App\Dto\PlayerHandDto;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

readonly class PointCalculatorMediator
{
    /** @param CardCalculatorInterface[] $calculators */
    public function __construct(
        #[TaggedIterator(CardCalculatorInterface::TAG_NAME)] private iterable $calculators
    ) {
    }

    public function getPoints(PlayerHandDto $playerHandDto): int
    {
        $points = 0;

        foreach ($this->calculators as $calculator) {
            $points += $calculator->getPoints($playerHandDto);
        }

        return $points;
    }
}
