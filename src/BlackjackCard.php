<?php

namespace Blackjack;

class BlackjackCard
{
    public const SUITS = ['スペード', 'ハート', 'ダイヤ', 'クラブ'];

    public const NUMBERS = ['A', '2', '3', '4', '5', '6', '7',  '8',  '9', '10', 'J', 'Q', 'K'];

    public const CARD_RANKS = [
            'A' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9,
            '10' => 10,
            'J' => 10,
            'Q' => 10,
            'K' => 10,
    ];

    public function __construct(private string $suit, private string $number)
    {
    }

    public function getCardSuit(): string
    {
        return $this->suit;
    }
    public function getCardNumber(): string
    {
        return $this->number;
    }

    public function getCardRank(): int
    {
        return self::CARD_RANKS[$this->number];
    }
}
