<?php

namespace App\Dto\Cards\CardBoost;

interface CardBoostDtoInterface
{
    public function getBoostedCardClassName(): string;

    public function getPointByQuantity(): int;
}
