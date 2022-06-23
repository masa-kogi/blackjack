<?php

namespace Blackjack;

interface BlackjackHandFixerInterface
{
    public function fixHand(BlackjackScoreCalculator $scoreCalculator, BlackjackDeck $deck): void;
}
