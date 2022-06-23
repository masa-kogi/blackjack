<?php

namespace Blackjack;

require_once 'BlackjackCard.php';
require_once 'BlackjackDeck.php';
require_once 'BlackjackHand.php';
require_once 'BlackjackDealer.php';
require_once 'BlackjackAnotherPlayer.php';
require_once 'BlackjackPlayerHandFixer.php';
require_once 'BlackjackScoreCalculator.php';
require_once 'BlackjackJudge.php';
require_once 'BlackjackGameInterface.php';

class ThreeOrFourPlayersBlackjackGame implements BlackjackGameInterface
{
    private BlackjackDeck $deck;
    private BlackjackYourPlayer $you;
    private BlackjackDealer $dealer;
    /**
     * @var array<AbstractBlackjackPlayer> $players
     */
    private array $players;
    private BlackjackJudge $judge;
    private BlackjackPlayerHandFixer $playerHandFixer;
    private BlackjackScoreCalculator $scoreCalculator;

    public function __construct(private int $playerNum)
    {
    }

    public function start(): void
    {
        $this->deck = new BlackjackDeck();
        $this->you = new BlackjackYourPlayer('あなた');
        $this->dealer = new BlackjackDealer('ディーラー');

        $this->players = [$this->you];

        for ($i = 1; $i < $this->playerNum - 1; $i++) {
            $this->players[] = new BlackjackAnotherPlayer("player{$i}");
        }

        // プレーヤーに2枚カードを配る
        foreach ($this->players as $player) {
            $card1 = $player->drawCard($this->deck);
            $player->showDrawnCard($card1);
            $card2 = $player->drawCard($this->deck);
            $player->showDrawnCard($card2);
            echo PHP_EOL;
        }

        // ディーラーに2枚カードを配る
        $dealerCard1 = $this->dealer->drawCard($this->deck);
        $this->dealer->showDrawnCard($dealerCard1);

        $dealerCard2 = $this->dealer->drawCard($this->deck);
        echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;
        echo PHP_EOL;

        $this->playerHandFixer = new BlackjackPlayerHandFixer();
        $this->scoreCalculator = new BlackjackScoreCalculator();

        // プレーヤーの得点を確定する
        array_map(
            fn ($player) => $this->playerHandFixer->fixHand($player, $this->scoreCalculator, $this->deck),
            $this->players
        );

        $this->dealer->showSecondCard($dealerCard2);

        // ディーラーの得点を確定する
        $dealerScore = $this->scoreCalculator->calculateScore($this->dealer->getCards());
        $dealerHand = new BlackjackHand(false, $dealerScore);
        $this->dealer->setHand($dealerHand);
        if (!$this->isAllPlayersBust($this->players)) {
            $this->playerHandFixer->fixHand($this->dealer, $this->scoreCalculator, $this->deck);
        }

        $this->showPlayersScore($this->players, $this->dealer);
        echo PHP_EOL;

        // 勝敗を判定する
        $this->judge = new BlackjackJudge();
        $results = $this->judge->judgeWinner($this->players, $this->dealer);
        $this->showResult($results);
        echo 'ブラックジャックを終了します。' . PHP_EOL;
    }

    /**
     * @param array<AbstractBlackjackPlayer> $players
     */
    private function isAllPlayersBust(array $players): bool
    {
        return count(array_unique(array_map(fn ($player) => $player->getHand()->getIsBust(), $players))) === 1 &&
            $players[0]->getHand()->getIsBust() === true;
    }

    /**
     * @param array<AbstractBlackjackPlayer> $players
     */
    public function showPlayersScore(array $players, BlackjackDealer $dealer): void
    {
        foreach ($players as $player) {
            echo $player->getName() . 'の得点は' . $player->getHand()->getScore() . 'です。' . PHP_EOL;
        }
        echo $dealer->getName() . 'の得点は' . $dealer->getHand()->getScore() . 'です。' . PHP_EOL;
    }

    /**
     * @param array<string, string> $results
     */
    public function showResult(array $results): void
    {
        foreach ($results as $player => $result) {
            if ($result === '勝ち') {
                echo $player . 'の' . $result . 'です！' . PHP_EOL;
            } elseif ($result === '負け') {
                echo $player . 'の' . $result . 'です。' . PHP_EOL;
            } elseif ($result === '引き分け') {
                echo $player . 'は' . $result . 'です。' . PHP_EOL;
            }
        }
    }
}
