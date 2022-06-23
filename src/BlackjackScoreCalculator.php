<?php

namespace Blackjack;

class BlackjackScoreCalculator
{
    private const ACE = 1;
    private const MAX_SCORE = 21;

    /**
     * @param array<BlackjackCard> $cards
     */
    public function calculateScore(array $cards): int
    {
        $cardRanks = array_map(fn ($card) => $card->getCardRank(), $cards);
        $score = array_sum($cardRanks);
        if ($this->hasAce($cardRanks) && !$this->isBust($score + 10)) {
            $score += 10;
        }
        return $score;
    }
    public function isBust(int $score): bool
    {
        return $score > self::MAX_SCORE;
    }

    /**
     * @param array<int> $cardRanks
     */
    private function hasAce(array $cardRanks): bool
    {
        return in_array(self::ACE, $cardRanks);
    }
}
