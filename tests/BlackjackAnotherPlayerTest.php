<?php

namespace Blackjack\Tests;

use PHPUnit\Framework\TestCase;
use Blackjack\BlackjackAnotherPlayer;
use Blackjack\BlackjackCard;
use Blackjack\BlackjackDeck;
use Blackjack\BlackjackHand;

require_once(__DIR__ . '/../src/blackjack/BlackjackAnotherPlayer.php');

class BlackjackAnotherPlayerTest extends TestCase
{
    public function testDrawCard(): void
    {
        $player = new BlackjackAnotherPlayer('player1');
        $deck = new BlackjackDeck();
        $this->assertInstanceOf(BlackjackCard::class, $player->drawCard($deck));
    }

    public function testShowDrawnCard(): void
    {
        $player1 = new BlackjackAnotherPlayer('player1');
        $expected = <<<EOM
        player1の引いたカードはハートのAです。

        EOM;
        $this->expectOutputString($expected);
        $player1->showDrawnCard(new BlackjackCard('ハート', 'A'));
    }
}
