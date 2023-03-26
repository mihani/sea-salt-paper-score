<?php

namespace App\Dto\Cards\Special;

use App\Dto\Cards\AbstractCardWithQuantity;

class MermaidCardDto extends AbstractCardWithQuantity
{
    /** @param array<int, int> $quantityByColor (sous la forme <index, quantity>) */
    public function __construct(
        private array $quantityByColor = []
    ) {
    }

    public function getQuantityByColor(): array
    {
        return $this->quantityByColor;
    }
}
