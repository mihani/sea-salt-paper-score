<?php

declare(strict_types=1);

namespace App\Config;

enum CollectionCard implements CardInterface
{
    case OCTOPUS;
    case PENGUIN;
    case SAILOR;
    case SHELL;

    public function translationKey(): string
    {
        return match ($this) {
            CollectionCard::OCTOPUS => 'card.collection.octopus',
            CollectionCard::PENGUIN => 'card.collection.penguin',
            CollectionCard::SAILOR => 'card.collection.sailor',
            CollectionCard::SHELL => 'card.collection.shell',
        };
    }

    public function getBooster(): ?BoostCard
    {
        return match ($this) {
            CollectionCard::OCTOPUS, CollectionCard::SHELL => null,
            CollectionCard::PENGUIN => BoostCard::PENGUIN_COLONY,
            CollectionCard::SAILOR => BoostCard::CAPTAIN,
        };
    }
}
