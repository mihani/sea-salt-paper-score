<?php

namespace App\Dto\Cards\CardBoost;

use App\Dto\Cards\Collection\PenguinCollectionCardDto;

class PenguinCardBoostDto implements CardBoostDtoInterface
{
    public function getBoostedCardClassName(): string
    {
        return PenguinCollectionCardDto::class;
    }

    public function getPointByQuantity(): int
    {
        return 2;
    }
}
