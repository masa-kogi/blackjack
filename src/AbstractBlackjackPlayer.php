<?php

namespace Blackjack;

require_once 'BlackjackCard.php';
require_once 'BlackjackDeck.php';
require_once 'BlackjackHand.php';

abstract class AbstractBlackjackPlayer
{
    public function __construct(protected string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array<BlackjackCard> $cards
     */
    abstract public function getCards(): array;

    /**
     * @param array<BlackjackCard> $cards
     */
    abstract public function setCards(array $cards): void;

    abstract public function getHand(): BlackjackHand;
    abstract public function setHand(BlackjackHand $hand): void;

    abstract public function drawCard(BlackjackDeck $deck): BlackjackCard;

    public function showDrawnCard(BlackjackCard $card): void
    {
        echo $this->getName() . 'の引いたカードは' . $card->getCardSuit() . 'の' . $card->getCardNumber() . 'です。' . PHP_EOL;
    }
}
