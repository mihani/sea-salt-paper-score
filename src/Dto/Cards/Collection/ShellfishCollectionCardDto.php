<?php

namespace App\Dto\Cards\Collection;

class ShellfishCollectionCardDto extends AbstractCollectionCardDto
{
    public function getPoints(): int
    {
        return [
            0 => 0,
            1 => 0,
            2 => 2,
            3 => 4,
            4 => 6,
            5 => 8,
            6 => 10,
        ][$this->getQuantity()];
    }
}
