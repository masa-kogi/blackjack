<?php

namespace Blackjack\Tests;

use PHPUnit\Framework\TestCase;
use Blackjack\BlackjackCard;
use Blackjack\BlackjackDeck;

require_once(__DIR__ . '/../src/blackjack/BlackjackDeck.php');


class BlackjackDeckTest extends TestCase
{
    public function testDealCard(): void
    {
        $deck = new BlackjackDeck();
        $this->assertInstanceOf(BlackjackCard::class, $deck->dealCard());
    }
}
