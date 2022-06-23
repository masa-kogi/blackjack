<?php

namespace Blackjack\Tests;

use PHPUnit\Framework\TestCase;
use Blackjack\BlackjackCard;
use Blackjack\BlackjackScoreCalculator;

require_once(__DIR__ . '/../src/blackjack/BlackjackScoreCalculator.php');

class BlackjackScoreCalculatorTest extends TestCase
{
    public function testCalculateScore(): void
    {
        $scoreCalculator = new BlackjackScoreCalculator();
        $this->assertSame(
            21,
            $scoreCalculator->calculateScore([new BlackjackCard('ハート', 'A'), new BlackjackCard('スペード', 'K')])
        );
        $this->assertSame(
            20,
            $scoreCalculator->calculateScore([new BlackjackCard('ハート', 'J'), new BlackjackCard('スペード', 'Q')])
        );
    }
}
