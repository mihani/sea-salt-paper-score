<?php

namespace App\Calculator;

use App\Calculator\CardCalculator\CardCalculatorInterface;
use App\Dto\Calculator\CalculatorResult;
use App\Dto\Calculator\EmbedDetailedPoint;
use App\Dto\PlayerHandDto;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class PointCalculatorMediator
{
    /**
     * @psalm-suppress InvalidAttribute
     *
     * @param CardCalculatorInterface[] $calculators
     */
    public function __construct(
        #[TaggedIterator(CardCalculatorInterface::TAG_NAME)] private readonly iterable $calculators
    ) {
    }

    public function getPoints(PlayerHandDto $playerHandDto): CalculatorResult
    {
        $result = new CalculatorResult();

        foreach ($this->calculators as $calculator) {
            $result->addResult(new EmbedDetailedPoint(get_class($calculator), $calculator->getPoints($playerHandDto)));
        }

        return $result;
    }
}
