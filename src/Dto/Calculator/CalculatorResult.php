<?php

namespace App\Dto\Calculator;

use App\Iterator\CalculatorResultIterator;

class CalculatorResult implements \IteratorAggregate
{
    private int $points = 0;
    private array $detailedPoints = [];

    public function addResult(DetailedPointInterface $detailedPoint): self
    {
        $this->detailedPoints[] = $detailedPoint;
        $this->points += $detailedPoint->getPoints();

        return $this;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function getDetailedPoints(): array
    {
        return $this->detailedPoints;
    }

    public function getIterator(): \Traversable
    {
        return (new CalculatorResultIterator($this->getDetailedPoints()))->getResult();
    }
}
