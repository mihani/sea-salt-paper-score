<?php

namespace App\Tests\Calculator;

use App\Calculator\CardCalculator\CardBoostCalculator;
use App\Calculator\CardCalculator\CollectionCardCalculator;
use App\Calculator\CardCalculator\DuoCardCalculator;
use App\Calculator\CardCalculator\MermaidCardCalculator;
use App\Calculator\PointCalculatorMediator;
use App\Config\BoostCard;
use App\Config\CollectionCard;
use App\Config\DuoCard;
use App\Config\SpecialCard;
use App\Dto\Calculator\CalculatorResult;
use App\Dto\Calculator\DetailedPointInterface;
use App\Dto\Cards\BoostCardDto;
use App\Dto\Cards\CardBoost\MarineCardBoostDto;
use App\Dto\Cards\CardBoost\PenguinCardBoostDto;
use App\Dto\Cards\Collection\PenguinCollectionCardDto;
use App\Dto\Cards\Collection\ShellfishCollectionCardDto;
use App\Dto\Cards\CollectionCardDto;
use App\Dto\Cards\Duo\FishDuoCardDto;
use App\Dto\Cards\Duo\ShipDuoCardDto;
use App\Dto\Cards\DuoCardDto;
use App\Dto\Cards\MermaidCardDto;
use App\Dto\PlayerHandDto;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PointCalculatorMediatorTest extends WebTestCase
{
    public function testGetPoints(): void
    {
        self::bootKernel();

        /** @var PointCalculatorMediator $mediator */
        $mediator = $this->getContainer()->get(PointCalculatorMediator::class);

        static::assertEquals(0, $mediator->getPoints(new PlayerHandDto())->getPoints());
        static::assertEquals(3, $mediator->getPoints(new PlayerHandDto(
            [self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::SHIP, 7)]
        ))->getPoints());

        $playerHand = new PlayerHandDto(
            [
                self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::SHIP, 7),
                self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::FISH, 5)
            ]
        );
        static::assertEquals(5, $mediator->getPoints($playerHand)->getPoints());

        $playerHand = new PlayerHandDto(
            [
                self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::SHIP, 7),
                self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::FISH, 5)
            ],
            [self::createCardWithQuantityDto(new CollectionCardDto(), CollectionCard::PENGUIN, 3)]
        );
        static::assertEquals(10, $mediator->getPoints($playerHand)->getPoints());

        $playerHand = new PlayerHandDto(
            [
                self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::SHIP, 7),
                self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::FISH, 5)
            ],
            [
                self::createCardWithQuantityDto(new CollectionCardDto(), CollectionCard::PENGUIN, 3),
                self::createCardWithQuantityDto(new CollectionCardDto(), CollectionCard::SHELL, 1)
            ],
        );
        static::assertEquals(10, $mediator->getPoints($playerHand)->getPoints());

        $playerHand = new PlayerHandDto(
            [
                self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::SHIP, 7),
                self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::FISH, 5)
            ],
            [
                self::createCardWithQuantityDto(new CollectionCardDto(), CollectionCard::PENGUIN, 3),
                self::createCardWithQuantityDto(new CollectionCardDto(), CollectionCard::SHELL, 1),
            ],
            [
                self::createCardDto(new BoostCardDto(), BoostCard::CAPTAIN)
            ]
        );
        static::assertEquals(10, $mediator->getPoints($playerHand)->getPoints());

        $playerHand = new PlayerHandDto(
            [
                self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::SHIP, 7),
                self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::FISH, 5)
            ],
            [
                self::createCardWithQuantityDto(new CollectionCardDto(), CollectionCard::PENGUIN, 3),
                self::createCardWithQuantityDto(new CollectionCardDto(), CollectionCard::SHELL, 1),
            ],
            [
                self::createCardDto(new BoostCardDto(), BoostCard::CAPTAIN),
                self::createCardDto(new BoostCardDto(), BoostCard::PENGUIN_COLONY)
            ]
        );
        static::assertEquals(16, $mediator->getPoints($playerHand)->getPoints());

        $playerHand = new PlayerHandDto(
            [
                self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::SHIP, 7),
                self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::FISH, 5)
            ],
            [
                self::createCardWithQuantityDto(new CollectionCardDto(), CollectionCard::PENGUIN, 3),
                self::createCardWithQuantityDto(new CollectionCardDto(), CollectionCard::SHELL, 1),
            ],
            [
                self::createCardDto(new BoostCardDto(), BoostCard::CAPTAIN),
                self::createCardDto(new BoostCardDto(), BoostCard::PENGUIN_COLONY)
            ],
            [
                self::createCardWithQuantityDto(new MermaidCardDto(), null, 3)
            ]
        );
        static::assertEquals(28, $mediator->getPoints($playerHand)->getPoints());
    }

//    public function testDetailedPoints()
//    {
//        self::bootKernel();
//
//        /** @var PointCalculatorMediator $mediator */
//        $mediator = $this->getContainer()->get(PointCalculatorMediator::class);
//
//        $this->assertEqualsPoints(
//            $mediator->getPoints(new PlayerHandDto([self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::SHIP, 7)])),
//            [
//                DuoCardCalculator::class => 3,
//                DuoCardDto::class => 3
//            ]
//        );
//
//        $this->assertEqualsPoints(
//            $mediator->getPoints(new PlayerHandDto(
//                [
//                    self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::SHIP, 7),
//                    self::createCardWithQuantityDto(new DuoCardDto(), DuoCard::FISH, 5),
//                ]
//            )),
//            [
//                DuoCardCalculator::class => 5,
//                DuoCardDto::class => 3,
//                DuoCardDto::class => 2
//            ]
//        );
//
//        $playerHand = new PlayerHandDto([new ShipDuoCardDto(7), new FishDuoCardDto(5)], [new PenguinCollectionCardDto(3)]);
//        $result = $mediator->getPoints($playerHand);
//        $this->assertEqualsPoints(
//            $result,
//            [
//                DuoCardCalculator::class => 5,
//                ShipDuoCardDto::class => 3,
//                FishDuoCardDto::class => 2,
//                CollectionCardCalculator::class => 5,
//                PenguinCollectionCardDto::class => 5
//            ]
//        );
//
//        $playerHand = new PlayerHandDto(
//            [new ShipDuoCardDto(7), new FishDuoCardDto(5)],
//            [new PenguinCollectionCardDto(3), new ShellfishCollectionCardDto(1)]
//        );
//        $result = $mediator->getPoints($playerHand);
//        $this->assertEqualsPoints(
//            $result,
//            [
//                DuoCardCalculator::class => 5,
//                ShipDuoCardDto::class => 3,
//                FishDuoCardDto::class => 2,
//                CollectionCardCalculator::class => 5,
//                PenguinCollectionCardDto::class => 5
//            ]
//        );
//
//        $playerHand = new PlayerHandDto(
//            [new ShipDuoCardDto(7), new FishDuoCardDto(5)],
//            [new PenguinCollectionCardDto(3), new ShellfishCollectionCardDto(1)],
//            [new MarineCardBoostDto()]
//        );
//        $result = $mediator->getPoints($playerHand);
//        $this->assertEqualsPoints(
//            $result,
//            [
//                DuoCardCalculator::class => 5,
//                ShipDuoCardDto::class => 3,
//                FishDuoCardDto::class => 2,
//                CollectionCardCalculator::class => 5,
//                PenguinCollectionCardDto::class => 5
//            ]
//        );
//
//        $playerHand = new PlayerHandDto(
//            [new ShipDuoCardDto(7), new FishDuoCardDto(5)],
//            [new PenguinCollectionCardDto(3), new ShellfishCollectionCardDto(1)],
//            [new MarineCardBoostDto(), new PenguinCardBoostDto()]
//        );
//        $result = $mediator->getPoints($playerHand);
//        $this->assertEqualsPoints(
//            $result,
//            [
//                DuoCardCalculator::class => 5,
//                ShipDuoCardDto::class => 3,
//                FishDuoCardDto::class => 2,
//                CollectionCardCalculator::class => 5,
//                PenguinCollectionCardDto::class => 5,
//                CardBoostCalculator::class => 6,
//                PenguinCardBoostDto::class => 6
//            ]
//        );
//
//        $playerHand = new PlayerHandDto(
//            [new ShipDuoCardDto(7), new FishDuoCardDto(5)],
//            [new PenguinCollectionCardDto(3), new ShellfishCollectionCardDto(1)],
//            [new MarineCardBoostDto(), new PenguinCardBoostDto()],
//            new MermaidCardDto(3, [4, 1, 2, 0, 6])
//        );
//        $result = $mediator->getPoints($playerHand);
//        $this->assertEqualsPoints(
//            $result,
//            [
//                DuoCardCalculator::class => 5,
//                ShipDuoCardDto::class => 3,
//                FishDuoCardDto::class => 2,
//                CollectionCardCalculator::class => 5,
//                PenguinCollectionCardDto::class => 5,
//                CardBoostCalculator::class => 6,
//                PenguinCardBoostDto::class => 6,
//                MermaidCardCalculator::class => 12,
//                MermaidCardDto::class.'-0' => 6,
//                MermaidCardDto::class.'-1' => 4,
//                MermaidCardDto::class.'-2' => 2
//            ]
//        );
//    }

    private function assertEqualsPoints(CalculatorResult $result, array $assertions): void
    {
        /** @var DetailedPointInterface $item */
        foreach ($result as $item) {
            $expected = $assertions[$item->getCardType()] ?? 0;
            $given = $item->getPoints();

            static::assertEquals($expected, $given, $item->getCardType());
        }
    }

    private static function createCardWithQuantityDto(DuoCardDto|CollectionCardDto|MermaidCardDto $cardDto, DuoCard|CollectionCard|null $type, int $quantity): DuoCardDto|CollectionCardDto|MermaidCardDto
    {
        if ($type !== null){
            $cardDto->type = $type;
        }

        $cardDto->quantity = $quantity;

        return $cardDto;
    }

    private static function createCardDto(BoostCardDto $cardDto, BoostCard $type): BoostCardDto
    {
        $cardDto->type = $type;

        return $cardDto;
    }
}
