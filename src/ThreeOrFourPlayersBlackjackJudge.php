<?php

namespace Blackjack;

require_once 'BlackjackDealer.php';
require_once 'BlackjackJudgeInterface.php';

class ThreeOrFourPlayersBlackjackJudge implements BlackjackJudgeInterface
{
    /**
     * @param array<AbstractBlackjackPlayer> $players
     * @return array<string, string> $results
     */
    public function judgeWinner(array $players, BlackjackDealer $dealer): array
    {
        $results = [];

        foreach ($players as $player) {
            if ($player->getHand()->getIsBust()) {
                $results[$player->getName()] = '負け';
            } elseif ($dealer->getHand()->getIsBust()) {
                $results[$player->getName()] = '勝ち';
            } elseif ($player->getHand()->getScore() > $dealer->getHand()->getScore()) {
                $results[$player->getName()] = '勝ち';
            } elseif ($player->getHand()->getScore() < $dealer->getHand()->getScore()) {
                $results[$player->getName()] = '負け';
            } elseif ($player->getHand()->getScore() === $dealer->getHand()->getScore()) {
                $results[$player->getName()] = '引き分け';
            }
        }
        return $results;
    }
}
