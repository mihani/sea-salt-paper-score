<?php

namespace App\Calculator\CardCalculator;

use App\Dto\Calculator\CalculatorResult;
use App\Dto\PlayerHandDto;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(self::TAG_NAME)]
interface CardCalculatorInterface
{
    public const TAG_NAME = 'app.point_calculator';

    public function getPoints(PlayerHandDto $playerHandDto): CalculatorResult;
}
