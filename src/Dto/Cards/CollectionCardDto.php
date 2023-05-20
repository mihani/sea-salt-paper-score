<?php

declare(strict_types=1);

namespace App\Dto\Cards;

use App\Config\CollectionCard;

class CollectionCardDto implements CardWithQuantityDtoInterface
{
    public ?CollectionCard $type = null;

    public int $quantity = 0;

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
