<?php

namespace App\Dto\Cards\Duo;

use App\Dto\Cards\AbstractCardWithQuantity;

class FishDuoCardDto extends AbstractCardWithQuantity
{
    public function __toString(): string
    {
        return 'Poisson';
    }
}
