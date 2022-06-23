<?php

namespace Blackjack\Tests;

use PHPUnit\Framework\TestCase;
use Blackjack\BlackjackCard;
use Blackjack\BlackjackDeck;
use Blackjack\BlackjackYourPlayer;

require_once(__DIR__ . '/../src/blackjack/BlackjackYourPlayer.php');


class BlackjackPlayerTest extends TestCase
{
    public function testDrawCard(): void
    {
        $player = new BlackjackYourPlayer('あなた');
        $deck = new BlackjackDeck();
        $this->assertInstanceOf(BlackjackCard::class, $player->drawCard($deck));
    }

    public function testShowDrawnCard(): void
    {
        $player = new BlackjackYourPlayer('あなた');
        $expected = <<<EOM
        あなたの引いたカードはハートのAです。

        EOM;
        $this->expectOutputString($expected);
        $player->showDrawnCard(new BlackjackCard('ハート', 'A'));
    }
}
