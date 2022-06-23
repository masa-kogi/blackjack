<?php

namespace Blackjack;

require_once 'BlackjackDeck.php';
require_once 'BlackjackDealer.php';
require_once 'BlackjackScoreCalculator.php';
require_once 'BlackjackHandFixerInterface.php';

class BlackjackDealerHandFixer implements BlackjackHandFixerInterface
{
    private const MINIMUM_SCORE = 17;

    public function __construct(private BlackjackDealer $dealer)
    {
    }

    public function fixHand(BlackjackScoreCalculator $scoreCalculator, BlackjackDeck $deck): void
    {
        $score = $scoreCalculator->calculateScore($this->dealer->getCards());
        $this->showCurrentScore($score);
        sleep(2);

        while ($this->isUnderMinimumScore($score)) {
            $dealerCard = $this->dealer->drawCard($deck);
            $this->dealer->showDrawnCard($dealerCard);
            $score = $scoreCalculator->calculateScore($this->dealer->getCards());
            $this->showCurrentScore($score);
            sleep(2);
        }

        $hand = new BlackjackHand($scoreCalculator->isBust($score), $score);
        $this->dealer->setHand($hand);
        echo PHP_EOL;
        return;
    }

    private function showCurrentScore(int $score): void
    {
        echo $this->dealer->getName() . 'の現在の得点は' . $score . 'です。' . PHP_EOL;
    }

    private function isUnderMinimumScore(int $score): bool
    {
        return $score < self::MINIMUM_SCORE;
    }
}
