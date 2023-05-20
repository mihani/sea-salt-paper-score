<?php

namespace App\Tests\Calculator\CardCalculator;

use App\Calculator\CardCalculator\CardBoostCalculator;
use App\Config\BoostCard;
use App\Config\CardInterface;
use App\Config\CollectionCard;
use App\Config\DuoCard;
use App\Dto\Cards\BoostCardDto;
use App\Dto\Cards\CardWithQuantityDtoInterface;
use App\Dto\Cards\Collection\MarineCollectionCardDto;
use App\Dto\Cards\Collection\PenguinCollectionCardDto;
use App\Dto\Cards\CollectionCardDto;
use App\Dto\Cards\Duo\ShipDuoCardDto;
use App\Dto\Cards\DuoCardDto;
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
        $playerHand = new PlayerHandDto([], [], [self::createCardDto(new BoostCardDto(), BoostCard::PENGUIN_COLONY)]);

        self::bootKernel();

        $cardBoostCalculator = $this->getContainer()->get(CardBoostCalculator::class);

        static::assertEquals(0, $cardBoostCalculator->getPoints($playerHand)->getPoints());

        $playerHand = new PlayerHandDto(
            [self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::SHIP, 2)],
            [self::createCardWithQuantityDto(new CollectionCardDto(), CollectionCard::SAILOR, 2)],
            [self::createCardDto(new BoostCardDto(), BoostCard::PENGUIN_COLONY)]);

        static::assertEquals(0, $cardBoostCalculator->getPoints($playerHand)->getPoints());
    }

    public function testWithoutBoostButWithBoostedCard(): void
    {
        $playerHand = new PlayerHandDto([], [self::createCardWithQuantityDto(new CollectionCardDto(), CollectionCard::PENGUIN, 1)], []);

        self::bootKernel();

        $cardBoostCalculator = $this->getContainer()->get(CardBoostCalculator::class);

        static::assertEquals(0, $cardBoostCalculator->getPoints($playerHand)->getPoints());
    }

    public function testWithBoostAndBoostedCard(): void
    {
        $playerHand = new PlayerHandDto(
            [],
            [self::createCardWithQuantityDto(new CollectionCardDto(), CollectionCard::PENGUIN, 3)],
            [self::createCardDto(new BoostCardDto(), BoostCard::PENGUIN_COLONY)]
        );

        self::bootKernel();

        $cardBoostCalculator = $this->getContainer()->get(CardBoostCalculator::class);

        static::assertEquals(6, $cardBoostCalculator->getPoints($playerHand)->getPoints());
    }

    private static function createCardWithQuantityDto(DuoCardDto|CollectionCardDto $cardDto, DuoCard|CollectionCard $type, int $quantity): DuoCardDto|CollectionCardDto
    {
        $cardDto->type = $type;
        $cardDto->quantity = $quantity;

        return $cardDto;
    }

    private static function createCardDto(BoostCardDto $cardDto, BoostCard $type): BoostCardDto
    {
        $cardDto->type = $type;

        return $cardDto;
    }
}
