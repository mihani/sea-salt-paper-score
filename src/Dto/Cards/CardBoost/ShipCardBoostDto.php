<?php

namespace App\Dto\Cards\CardBoost;

use App\Dto\Cards\Duo\ShipDuoCardDto;

class ShipCardBoostDto implements CardBoostDtoInterface
{
    public function getBoostedCardClassName(): string
    {
        return ShipDuoCardDto::class;
    }

    public function getPointByQuantity(): int
    {
        return 1;
    }
}
