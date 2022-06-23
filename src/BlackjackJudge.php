<?php

namespace Blackjack;

require_once 'BlackjackDealer.php';
require_once 'TwoPlayersBlackjackJudge.php';
require_once 'ThreeOrFourPlayersBlackjackJudge.php';

class BlackjackJudge
{
    /**
     * @param array<AbstractBlackjackPlayer> $players
     * @return array<string, string> results
     */
    public function judgeWinner(array $players, BlackjackDealer $dealer): array
    {
        $judge = $this->getJudge($players);
        $results = $judge->judgeWinner($players, $dealer);
        return $results;
    }

    /**
     * @param array<AbstractBlackjackPlayer> $players
     */
    private function getJudge(array $players): BlackjackJudgeInterface
    {
        if (count($players) === 1) {
            return new TwoPlayersBlackjackJudge();
        }
        return new ThreeOrFourPlayersBlackjackJudge();
    }
}
