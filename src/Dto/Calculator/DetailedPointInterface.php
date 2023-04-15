<?php

namespace App\Dto\Calculator;

interface DetailedPointInterface
{
    public function getPoints(): int;

    public function getCardType(): string;
}
