<?php

declare(strict_types=1);

namespace App\Config;

enum DuoCard implements CardInterface
{
    case CRAB;
    case FISH;
    case SHARK;
    case SHIP;

    public function translationKey(): string
    {
        return match ($this) {
            DuoCard::CRAB => 'card.duo.crab',
            DuoCard::FISH => 'card.duo.fish',
            DuoCard::SHARK => 'card.duo.shark',
            DuoCard::SHIP => 'card.duo.ship',
        };
    }

    public function getBooster(): ?BoostCard
    {
        return match ($this) {
            DuoCard::CRAB, DuoCard::SHARK => null,
            DuoCard::FISH => BoostCard::SHOAL_OF_FISH,
            DuoCard::SHIP => BoostCard::LIGHTHOUSE
        };
    }
}
