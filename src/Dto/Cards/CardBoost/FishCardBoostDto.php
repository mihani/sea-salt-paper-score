<?php

namespace App\Dto\Cards\CardBoost;

use App\Dto\Cards\Duo\FishDuoCardDto;

class FishCardBoostDto implements CardBoostDtoInterface
{
    public function getBoostedCardClassName(): string
    {
        return FishDuoCardDto::class;
    }

    public function getPointByQuantity(): int
    {
        return 1;
    }
}
