<?php

namespace Blackjack;

require_once 'BlackjackDeck.php';
require_once 'AbstractBlackjackPlayer.php';
require_once 'BlackjackYourPlayer.php';
require_once 'BlackjackYourHandFixer.php';
require_once 'BlackjackAnotherPlayer.php';
require_once 'BlackjackAnotherPlayerHandFixer.php';
require_once 'BlackjackDealer.php';
require_once 'BlackjackDealerHandFixer.php';
require_once 'BlackjackScoreCalculator.php';

class BlackjackPlayerHandFixer
{
    public function __construct()
    {
    }

    public function fixHand(
        AbstractBlackjackPlayer $player,
        BlackjackScoreCalculator $scoreCalculator,
        BlackjackDeck $deck
    ): void {
        $handFixer = $this->getHandFixer($player);
        $handFixer->fixHand($scoreCalculator, $deck);
    }

    private function getHandFixer(AbstractBlackjackPlayer $player): BlackjackHandFixerInterface
    {
        if ($player instanceof BlackjackYourPlayer) {
            return new BlackjackYourHandFixer($player);
        } elseif ($player instanceof BlackjackAnotherPlayer) {
            return new BlackjackAnotherPlayerHandFixer($player);
        } elseif ($player instanceof BlackjackDealer) {
            return new BlackjackDealerHandFixer($player);
        }
    }
}
