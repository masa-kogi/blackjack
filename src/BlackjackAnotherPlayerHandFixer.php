<?php

namespace Blackjack;

require_once 'BlackjackDeck.php';
require_once 'BlackjackHand.php';
require_once 'BlackjackAnotherPlayer.php';
require_once 'BlackjackScoreCalculator.php';
require_once 'BlackjackHandFixerInterface.php';

class BlackjackAnotherPlayerHandFixer implements BlackjackHandFixerInterface
{
    private const MINIMUM_SCORE = 17;

    public function __construct(private BlackjackAnotherPlayer $anotherPlayer)
    {
    }

    public function fixHand(BlackjackScoreCalculator $scoreCalculator, BlackjackDeck $deck): void
    {
        $score = $scoreCalculator->calculateScore($this->anotherPlayer->getCards());
        $this->showCurrentScore($score);
        sleep(2);

        while ($this->isUnderMinimumScore($score)) {
            $anotherPlayerCard = $this->anotherPlayer->drawCard($deck);
            $this->anotherPlayer->showDrawnCard($anotherPlayerCard);
            $score = $scoreCalculator->calculateScore($this->anotherPlayer->getCards());
            $this->showCurrentScore($score);
            sleep(2);
        }

        $hand = new BlackjackHand($scoreCalculator->isBust($score), $score);
        $this->anotherPlayer->setHand($hand);
        echo PHP_EOL;
        return;
    }

    private function showCurrentScore(int $score): void
    {
        echo $this->anotherPlayer->getName() . 'の現在の得点は' . $score . 'です。' . PHP_EOL;
    }

    private function isUnderMinimumScore(int $totalScore): bool
    {
        return $totalScore < self::MINIMUM_SCORE;
    }
}
