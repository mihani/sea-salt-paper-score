<?php

namespace App\Dto\Cards\Collection;

use App\Dto\Cards\CardWithQuantityDtoInterface;

interface CollectionCardDtoInterface extends CardWithQuantityDtoInterface
{
    public function getPoints(): int;
}
