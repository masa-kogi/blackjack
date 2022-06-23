<?php

namespace Blackjack\Tests;

use PHPUnit\Framework\TestCase;
use Blackjack\BlackjackCard;
use Blackjack\BlackjackDeck;
use Blackjack\BlackjackDealer;
use Blackjack\BlackjackHand;

require_once(__DIR__ . '/../src/blackjack/BlackjackDealer.php');


class BlackjackDealerTest extends TestCase
{
    public function testDrawCard(): void
    {
        $dealer = new BlackjackDealer('ディーラー');
        $deck = new BlackjackDeck();
        $this->assertInstanceOf(BlackjackCard::class, $dealer->drawCard($deck));
    }

    public function testShowDrawnCard(): void
    {
        $dealer = new BlackjackDealer('ディーラー');
        $expected = <<<EOM
        ディーラーの引いたカードはハートのAです。

        EOM;
        $this->expectOutputString($expected);
        $dealer->showDrawnCard(new BlackjackCard('ハート', 'A'));
    }

    public function testShowSecondCard(): void
    {
        $dealer = new BlackjackDealer('ディーラー');
        $expected = <<<EOM
        ディーラーの引いた2枚目のカードはハートのAでした。

        EOM;
        $this->expectOutputString($expected);
        $dealer->showSecondCard(new BlackjackCard('ハート', 'A'));
    }
}
