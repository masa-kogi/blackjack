<?php

namespace Blackjack;

require_once 'BlackjackDeck.php';
require_once 'BlackjackHand.php';
require_once 'AbstractBlackjackPlayer.php';
require_once 'BlackjackYourPlayer.php';
require_once 'BlackjackScoreCalculator.php';
require_once 'BlackjackHandFixerInterface.php';

class BlackjackYourHandFixer implements BlackjackHandFixerInterface
{
    public function __construct(private BlackjackYourPlayer $you)
    {
    }

    public function fixHand(BlackjackScoreCalculator $scoreCalculator, BlackjackDeck $deck): void
    {
        $score = $scoreCalculator->calculateScore($this->you->getCards());

        while (!$scoreCalculator->isBust($score)) {
            $this->showCurrentScore($score);
            $ans = trim(fgets(STDIN));
            while (!$this->isProperAns($ans)) {
                echo 'YかNを入力してください。' . PHP_EOL;
                $ans = trim(fgets(STDIN));
            }
            if ($ans === 'y') {
                $playerCard = $this->you->drawCard($deck);
                $this->you->showDrawnCard($playerCard);
                $score = $scoreCalculator->calculateScore($this->you->getCards());
            } elseif ($ans === 'n') {
                break;
            }
        }
        $hand = new BlackjackHand($scoreCalculator->isBust($score), $score);
        $this->you->setHand($hand);
        echo PHP_EOL;
        return;
    }

    private function showCurrentScore(int $score): void
    {
        echo $this->you->getName() . 'の現在の得点は' . $score . 'です。カードを引きますか？（Y/N）' . PHP_EOL;
    }

    private function isProperAns(string $ans): bool
    {
        return in_array(strtolower($ans), ['y', 'n']);
    }
}
