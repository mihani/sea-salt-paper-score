<?php

namespace App\Dto\Cards\CardBoost;

use App\Dto\Cards\Collection\MarineCollectionCardDto;

class MarineCardBoostDto implements CardBoostDtoInterface
{
    public function getBoostedCardClassName(): string
    {
        return MarineCollectionCardDto::class;
    }

    public function getPointByQuantity(): int
    {
        return 3;
    }
}
