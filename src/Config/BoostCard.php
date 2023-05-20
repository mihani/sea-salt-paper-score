<?php

declare(strict_types=1);

namespace App\Config;

enum BoostCard implements CardInterface
{
    case CAPTAIN;
    case LIGHTHOUSE;
    case PENGUIN_COLONY;
    case SHOAL_OF_FISH;

    public function translationKey(): string
    {
        return match ($this) {
            BoostCard::CAPTAIN => 'card.boost.captain',
            BoostCard::LIGHTHOUSE => 'card.boost.lighthouse',
            BoostCard::PENGUIN_COLONY => 'card.boost.penguin_colony',
            BoostCard::SHOAL_OF_FISH => 'card.boost.shoal_of_fish',
        };
    }

    public function point(): int
    {
        return match ($this) {
            BoostCard::CAPTAIN => 3,
            BoostCard::LIGHTHOUSE => 1,
            BoostCard::PENGUIN_COLONY => 2,
            BoostCard::SHOAL_OF_FISH => 1,
        };
    }
}
