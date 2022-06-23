<?php

namespace Blackjack;

class BlackjackHand
{
    public function __construct(protected bool $isBust, protected int $score)
    {
    }

    public function getIsBust(): bool
    {
        return $this->isBust;
    }

    public function getScore(): int
    {
        return $this->score;
    }
}
