<?php

namespace App\Tests\Calculator;

use App\Calculator\PointCalculatorMediator;
use App\Dto\Cards\CardBoost\FishCardBoostDto;
use App\Dto\Cards\CardBoost\MarineCardBoostDto;
use App\Dto\Cards\CardBoost\PenguinCardBoostDto;
use App\Dto\Cards\Collection\PenguinCollectionCardDto;
use App\Dto\Cards\Collection\ShellfishCollectionCardDto;
use App\Dto\Cards\Duo\FishDuoCardDto;
use App\Dto\Cards\Duo\ShipDuoCardDto;
use App\Dto\Cards\Special\MermaidCardDto;
use App\Dto\PlayerHandDto;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PointCalculatorMediatorTest extends WebTestCase
{
    public function testCases(): void
    {
        self::bootKernel();

        /** @var PointCalculatorMediator $mediator */
        $mediator = $this->getContainer()->get(PointCalculatorMediator::class);

        static::assertEquals(0, $mediator->getPoints(new PlayerHandDto()));
        static::assertEquals(3, $mediator->getPoints(new PlayerHandDto([new ShipDuoCardDto(7)])));

        $playerHand = new PlayerHandDto([new ShipDuoCardDto(7), new FishDuoCardDto(5)]);
        static::assertEquals(5, $mediator->getPoints($playerHand));

        $playerHand = new PlayerHandDto([new ShipDuoCardDto(7), new FishDuoCardDto(5)], [new PenguinCollectionCardDto(3)]);
        static::assertEquals(10, $mediator->getPoints($playerHand));

        $playerHand = new PlayerHandDto(
            [new ShipDuoCardDto(7), new FishDuoCardDto(5)],
            [new PenguinCollectionCardDto(3), new ShellfishCollectionCardDto(1)]
        );
        static::assertEquals(10, $mediator->getPoints($playerHand));

        $playerHand = new PlayerHandDto(
            [new ShipDuoCardDto(7), new FishDuoCardDto(5)],
            [new PenguinCollectionCardDto(3), new ShellfishCollectionCardDto(1)],
            [new MarineCardBoostDto()]
        );
        static::assertEquals(10, $mediator->getPoints($playerHand));

        $playerHand = new PlayerHandDto(
            [new ShipDuoCardDto(7), new FishDuoCardDto(5)],
            [new PenguinCollectionCardDto(3), new ShellfishCollectionCardDto(1)],
            [new MarineCardBoostDto(), new PenguinCardBoostDto()]
        );
        static::assertEquals(16, $mediator->getPoints($playerHand));

        $playerHand = new PlayerHandDto(
            [new ShipDuoCardDto(7), new FishDuoCardDto(5)],
            [new PenguinCollectionCardDto(3), new ShellfishCollectionCardDto(1)],
            [new MarineCardBoostDto(), new PenguinCardBoostDto()],
            new MermaidCardDto(3, [4, 1, 2, 0, 6])
        );
        static::assertEquals(28, $mediator->getPoints($playerHand));
    }
}