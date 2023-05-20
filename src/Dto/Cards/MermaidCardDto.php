<?php

declare(strict_types=1);

namespace App\Dto\Cards;

class MermaidCardDto implements CardWithQuantityDtoInterface
{
    public int $quantity = 0;

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
