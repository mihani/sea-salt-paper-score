<?php

namespace App\Dto\Cards\Collection;

class MarineCollectionCardDto extends AbstractCollectionCardDto
{
    public function getPoints(): int
    {
        return [
            0 => 0,
            1 => 0,
            2 => 5,
        ][$this->getQuantity()];
    }
}
