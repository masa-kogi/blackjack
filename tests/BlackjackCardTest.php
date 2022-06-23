<?php

namespace Blackjack\Tests;

use PHPUnit\Framework\TestCase;
use Blackjack\BlackjackCard;

require_once(__DIR__ . '/../src/blackjack/BlackjackCard.php');


class BlackjackCardTest extends TestCase
{
    public function testGetCardSuite(): void
    {
        $card = new BlackjackCard('クラブ', 'J');
        $this->assertSame('クラブ', $card->getCardSuit());
    }

    public function testGetCardNumber(): void
    {
        $card = new BlackjackCard('クラブ', 'J');
        $this->assertSame('J', $card->getCardNumber());
    }

    public function testGetCardRank(): void
    {
        $card = new BlackjackCard('クラブ', 'J');
        $this->assertSame(10, $card->getCardRank());
    }
}
