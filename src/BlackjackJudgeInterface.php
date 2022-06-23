<?php

namespace Blackjack;

interface BlackjackJudgeInterface
{
    /**
     * @param array<AbstractBlackjackPlayer> $players
     * @return array<string, string> $results
     */
    public function judgeWinner(array $players, BlackjackDealer $dealer): array;
}
