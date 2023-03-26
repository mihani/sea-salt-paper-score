<?php

namespace App\Dto\Cards;

abstract class AbstractCardWithQuantity extends AbstractCardDto implements CardWithQuantityDtoInterface
{
    use CardWithQuantityDtoTrait;
}
