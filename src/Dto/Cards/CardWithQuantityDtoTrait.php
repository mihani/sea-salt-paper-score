<?php

namespace App\Dto\Cards;

trait CardWithQuantityDtoTrait
{
    private int $quantity = 0;

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
