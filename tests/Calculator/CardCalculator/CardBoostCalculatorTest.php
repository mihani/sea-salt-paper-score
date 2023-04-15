<?php

namespace App\Tests\Calculator\CardCalculator;

use App\Calculator\CardCalculator\CardBoostCalculator;
use App\Dto\Cards\CardBoost\PenguinCardBoostDto;
use App\Dto\Cards\Collection\MarineCollectionCardDto;
use App\Dto\Cards\Collection\PenguinCollectionCardDto;
use App\Dto\Cards\Duo\ShipDuoCardDto;
use App\Dto\PlayerHandDto;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardBoostCalculatorTest extends WebTestCase
{
    public function testNoBoostedCard(): void
    {
        $playerHand = new PlayerHandDto();

        self::bootKernel();

        $cardBoostCalculator = $this->getContainer()->get(CardBoostCalculator::class);

        static::assertEquals(0, $cardBoostCalculator->getPoints($playerHand)->getPoints());
    }

    public function testWithBoostButWithoutBoostedCard(): void
    {
        $playerHand = new PlayerHandDto([], [], [new PenguinCardBoostDto()]);

        self::bootKernel();

        $cardBoostCalculator = $this->getContainer()->get(CardBoostCalculator::class);

        static::assertEquals(0, $cardBoostCalculator->getPoints($playerHand)->getPoints());

        $playerHand = new PlayerHandDto([new ShipDuoCardDto(2)], [new MarineCollectionCardDto(2)], [new PenguinCardBoostDto()]);

        static::assertEquals(0, $cardBoostCalculator->getPoints($playerHand)->getPoints());
    }

    public function testWithoutBoostButWithBoostedCard(): void
    {
        $playerHand = new PlayerHandDto([], [new PenguinCollectionCardDto(1)], []);

        self::bootKernel();

        $cardBoostCalculator = $this->getContainer()->get(CardBoostCalculator::class);

        static::assertEquals(0, $cardBoostCalculator->getPoints($playerHand)->getPoints());
    }

    public function testWithBoostAndBoostedCard(): void
    {
        $playerHand = new PlayerHandDto([], [new PenguinCollectionCardDto(3)], [new PenguinCardBoostDto()]);

        self::bootKernel();

        $cardBoostCalculator = $this->getContainer()->get(CardBoostCalculator::class);

        static::assertEquals(6, $cardBoostCalculator->getPoints($playerHand)->getPoints());
    }
}