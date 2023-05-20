<?php

declare(strict_types=1);

namespace App\Config;

enum SpecialCard implements CardInterface
{
    case MERMAID;

    public function translationKey(): string
    {
        return match ($this) {
            SpecialCard::MERMAID => 'card.special.mermaid',
        };
    }
}
