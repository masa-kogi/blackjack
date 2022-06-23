<?php

namespace Blackjack;

require_once 'BlackjackDealer.php';
require_once 'BlackjackJudgeInterface.php';

class TwoPlayersBlackjackJudge implements BlackjackJudgeInterface
{
    /**
     * @param array<AbstractBlackjackPlayer> $players
     * @return array<string, string> $results
     */
    public function judgeWinner(array $players, BlackjackDealer $dealer): array
    {
        $you = $players[0];
        $results = [];

        if ($you->getHand()->getIsBust()) {
            $results[$you->getName()] = '負け';
        } elseif ($dealer->getHand()->getIsBust()) {
            $results[$you->getName()] = '勝ち';
        } elseif ($you->getHand()->getScore() > $dealer->getHand()->getScore()) {
            $results[$you->getName()] = '勝ち';
        } elseif ($you->getHand()->getScore() < $dealer->getHand()->getScore()) {
            $results[$you->getName()] = '負け';
        } elseif ($you->getHand()->getScore() === $dealer->getHand()->getScore()) {
            $results[$you->getName()] = '引き分け';
        }
        return $results;
    }
}
