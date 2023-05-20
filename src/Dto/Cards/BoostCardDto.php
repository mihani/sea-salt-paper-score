<?php

declare(strict_types=1);

namespace App\Dto\Cards;

use App\Config\BoostCard;

class BoostCardDto implements CardDtoInterface
{
    public ?BoostCard $type = null;
}
