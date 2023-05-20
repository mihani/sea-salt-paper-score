<?php

namespace App\Iterator;

use App\Dto\Calculator\DetailedPoint;
use App\Dto\Calculator\DetailedPointInterface;

/**
 * @template-implements \RecursiveIterator<int, CalculatorResultIterator>
 */
class CalculatorResultIterator implements \RecursiveIterator
{
    private int $position = 0;

    public function __construct(
        private readonly array $detailedPoints
    ) {
    }

    public function current(): DetailedPointInterface
    {
        return $this->detailedPoints[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->detailedPoints[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function hasChildren(): bool
    {
        $detailPoints = $this->detailedPoints[$this->position];

        return $detailPoints instanceof DetailedPoint && !empty($detailPoints->getDetailedPoints());
    }

    public function getChildren(): self
    {
        return new self($this->detailedPoints[$this->position]->getDetailedPoints());
    }

    public function getResult(): \RecursiveIteratorIterator
    {
        return new \RecursiveIteratorIterator($this, \RecursiveIteratorIterator::SELF_FIRST);
    }
}
