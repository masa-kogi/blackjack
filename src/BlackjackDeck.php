<?php

namespace Blackjack;

require_once 'BlackjackCard.php';

class BlackjackDeck
{
    /**
     * @var array<BlackjackCard> $cards
     */
    public array $cards;

    public function __construct()
    {
        $cards = [];
        foreach (BlackjackCard::SUITS as $suit) {
            foreach (BlackjackCard::NUMBERS as $number) {
                $cards[] = new BlackjackCard($suit, $number);
            }
        }
        shuffle($cards);
        $this->cards = $cards;
    }

    public function dealCard(): BlackjackCard
    {
        return array_shift($this->cards);
    }
}
