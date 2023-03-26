<?php

namespace App\Dto\Cards\Collection;

class PenguinCollectionCardDto extends AbstractCollectionCardDto
{
    public function getPoints(): int
    {
        return [
            1 => 1,
            2 => 3,
            3 => 5,
        ][$this->getQuantity()];
    }
}
