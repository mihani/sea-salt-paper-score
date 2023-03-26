<?php

namespace App\Tests\Calculator;

use App\Calculator\CardCalculator\CardBoostCalculator;
use App\Dto\PlayerHandDto;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardBoostCalculatorTest extends WebTestCase
{
    public function testNoBoostedCard()
    {
        $playerHand = new PlayerHandDto();

        self::bootKernel();

        $cardBoostCalculator = $this->getContainer()->get(CardBoostCalculator::class);

        static::assertEquals(0, $cardBoostCalculator->getPoints($playerHand));
    }
}