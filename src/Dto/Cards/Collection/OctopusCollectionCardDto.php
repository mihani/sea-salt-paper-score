<?php

namespace App\Dto\Cards\Collection;

class OctopusCollectionCardDto extends AbstractCollectionCardDto
{
    public function getPoints(): int
    {
        return [
            0 => 0,
            1 => 0,
            2 => 3,
            3 => 6,
            4 => 9,
            5 => 12,
        ][$this->getQuantity()];
    }
}
