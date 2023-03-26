<?php

namespace App\Dto\Cards\Duo;

use App\Dto\Cards\AbstractCardWithQuantity;

class CrabDuoCardDto extends AbstractCardWithQuantity
{
    public function __toString(): string
    {
        return 'Crabe';
    }
}
