<?php

namespace Blackjack\Tests;

use PHPUnit\Framework\TestCase;
use Blackjack\BlackjackYourPlayer;
use Blackjack\BlackjackAnotherPlayer;
use Blackjack\BlackjackDealer;
use Blackjack\BlackjackHand;
use Blackjack\ThreeOrFourPlayersBlackjackJudge;

require_once(__DIR__ . '/../src/blackjack/ThreeOrFourPlayersBlackjackJudge.php');


class ThreeOrFourPlayersBlackjackJudgeTest extends TestCase
{
    public function testJudgeWinner(): void
    {
        $judge = new ThreeOrFourPlayersBlackjackJudge();
        $you = new BlackjackYourPlayer('あなた');
        $player1 = new BlackjackAnotherPlayer('player1');
        $dealer = new BlackjackDealer('ディーラー');

        $you->setHand(new BlackjackHand(false, 21));
        $player1->setHand(new BlackjackHand(false, 21));
        $dealer->setHand(new BlackjackHand(true, 22));
        $this->assertSame(['あなた' => '勝ち', 'player1' => '勝ち'], $judge->judgeWinner([$you, $player1], $dealer));

        $you->setHand(new BlackjackHand(false, 21));
        $player1->setHand(new BlackjackHand(true, 22));
        $dealer->setHand(new BlackjackHand(false, 21));
        $this->assertSame(['あなた' => '引き分け', 'player1' => '負け'], $judge->judgeWinner([$you, $player1], $dealer));

        $you->setHand(new BlackjackHand(true, 22));
        $player1->setHand(new BlackjackHand(false, 21));
        $dealer->setHand(new BlackjackHand(false, 21));
        $this->assertSame(['あなた' => '負け', 'player1' => '引き分け'], $judge->judgeWinner([$you, $player1], $dealer));

        $you->setHand(new BlackjackHand(true, 22));
        $player1->setHand(new BlackjackHand(true, 22));
        $dealer->setHand(new BlackjackHand(false, 21));
        $this->assertSame(['あなた' => '負け', 'player1' => '負け'], $judge->judgeWinner([$you, $player1], $dealer));
        $you->setHand(new BlackjackHand(true, 22));

        $you->setHand(new BlackjackHand(false, 21));
        $player1->setHand(new BlackjackHand(false, 21));
        $dealer->setHand(new BlackjackHand(false, 21));
        $this->assertSame(['あなた' => '引き分け', 'player1' => '引き分け'], $judge->judgeWinner([$you, $player1], $dealer));

        $you->setHand(new BlackjackHand(false, 21));
        $player1->setHand(new BlackjackHand(false, 20));
        $dealer->setHand(new BlackjackHand(false, 20));
        $this->assertSame(['あなた' => '勝ち', 'player1' => '引き分け'], $judge->judgeWinner([$you, $player1], $dealer));

        $you->setHand(new BlackjackHand(false, 21));
        $player1->setHand(new BlackjackHand(false, 19));
        $dealer->setHand(new BlackjackHand(false, 20));
        $this->assertSame(['あなた' => '勝ち', 'player1' => '負け'], $judge->judgeWinner([$you, $player1], $dealer));

        $you->setHand(new BlackjackHand(false, 20));
        $player1->setHand(new BlackjackHand(false, 21));
        $dealer->setHand(new BlackjackHand(false, 21));
        $this->assertSame(['あなた' => '負け', 'player1' => '引き分け'], $judge->judgeWinner([$you, $player1], $dealer));

        $you->setHand(new BlackjackHand(false, 19));
        $player1->setHand(new BlackjackHand(false, 21));
        $dealer->setHand(new BlackjackHand(false, 20));
        $this->assertSame(['あなた' => '負け', 'player1' => '勝ち'], $judge->judgeWinner([$you, $player1], $dealer));

        $you->setHand(new BlackjackHand(false, 20));
        $player1->setHand(new BlackjackHand(false, 20));
        $dealer->setHand(new BlackjackHand(false, 21));
        $this->assertSame(['あなた' => '負け', 'player1' => '負け'], $judge->judgeWinner([$you, $player1], $dealer));


        $player2 = new BlackjackAnotherPlayer('player2');
        $player2->setHand(new BlackjackHand(false, 20));
        $this->assertSame(
            ['あなた' => '負け', 'player1' => '負け', 'player2' => '負け'],
            $judge->judgeWinner([$you, $player1, $player2], $dealer)
        );
    }
}
