<?php

namespace Blackjack;

require_once 'BlackjackCard.php';
require_once 'BlackjackDeck.php';
require_once 'BlackjackHand.php';
require_once 'AbstractBlackjackPlayer.php';

class BlackjackAnotherPlayer extends AbstractBlackjackPlayer
{
    /**
     * @var array<BlackjackCard> $cards
     */
    private array $cards = [];
    private BlackjackHand $hand;

    /**
     * @return array<BlackjackCard> $cards
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @param array<BlackjackCard> $cards
     */
    public function setCards(array $cards): void
    {
        $this->cards = $cards;
    }

    public function getHand(): BlackjackHand
    {
        return $this->hand;
    }

    public function setHand(BlackjackHand $hand): void
    {
        $this->hand = $hand;
    }

    public function drawCard(BlackjackDeck $deck): BlackjackCard
    {
        $card = $deck->dealCard();
        $this->cards[] = $card;
        return $card;
    }
}
