<?php

namespace Blackjack\Tests;

use PHPUnit\Framework\TestCase;
use Blackjack\BlackjackDealer;
use Blackjack\BlackjackHand;
use Blackjack\BlackjackYourPlayer;
use Blackjack\TwoPlayersBlackjackJudge;

require_once(__DIR__ . '/../src/blackjack/TwoPlayersBlackjackJudge.php');


class TwoPlayersBlackjackJudgeTest extends TestCase
{
    public function testJudgeWinner(): void
    {
        $judge = new TwoPlayersBlackjackJudge();
        $you = new BlackjackYourPlayer('あなた');
        $dealer = new BlackjackDealer('ディーラー');
        $you->setHand(new BlackjackHand(true, 22));
        $dealer->setHand(new BlackjackHand(false, 21));
        $this->assertSame(['あなた' => '負け'], $judge->judgeWinner([$you], $dealer));

        $you->setHand(new BlackjackHand(false, 21));
        $dealer->setHand(new BlackjackHand(true, 22));
        $this->assertSame(['あなた' => '勝ち'], $judge->judgeWinner([$you], $dealer));

        $you->setHand(new BlackjackHand(false, 21));
        $dealer->setHand(new BlackjackHand(false, 20));
        $this->assertSame(['あなた' => '勝ち'], $judge->judgeWinner([$you], $dealer));

        $you->setHand(new BlackjackHand(false, 20));
        $dealer->setHand(new BlackjackHand(false, 21));
        $this->assertSame(['あなた' => '負け'], $judge->judgeWinner([$you], $dealer));

        $you->setHand(new BlackjackHand(false, 21));
        $dealer->setHand(new BlackjackHand(false, 21));
        $this->assertSame(['あなた' => '引き分け'], $judge->judgeWinner([$you], $dealer));
    }
}
