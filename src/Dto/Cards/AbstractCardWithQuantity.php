<?php

namespace App\Dto\Cards;

abstract class AbstractCardWithQuantity extends AbstractCardDto implements CardWithQuantityDtoInterface
{
    public function __construct(
        private readonly int $quantity
    ) {
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
