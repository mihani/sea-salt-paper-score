<?php

declare(strict_types=1);

namespace App\Dto\Cards;

use App\Config\DuoCard;

class DuoCardDto implements CardWithQuantityDtoInterface
{
    public ?DuoCard $type = null;

    public int $quantity = 0;

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
