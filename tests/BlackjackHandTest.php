<?php

namespace Blackjack\Tests;

use PHPUnit\Framework\TestCase;
use Blackjack\BlackjackHand;

require_once(__DIR__ . '/../src/blackjack/BlackjackHand.php');


class BlackjackHandTest extends TestCase
{
    public function testGetIsBust(): void
    {
        $hand = new BlackjackHand(false, 19);
        $this->assertSame(false, $hand->getIsBust());
    }

    public function testGetScore(): void
    {
        $hand = new BlackjackHand(false, 19);
        $this->assertSame(19, $hand->getScore());
    }
}
