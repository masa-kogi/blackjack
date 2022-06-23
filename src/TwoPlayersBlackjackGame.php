<?php

namespace Blackjack;

require_once 'BlackjackCard.php';
require_once 'BlackjackDeck.php';
require_once 'BlackjackHand.php';
require_once 'BlackjackYourPlayer.php';
require_once 'BlackjackDealer.php';
require_once 'BlackjackPlayerHandFixer.php';
require_once 'BlackjackScoreCalculator.php';
require_once 'BlackjackJudge.php';
require_once 'BlackjackGameInterface.php';

class TwoPlayersBlackjackGame implements BlackjackGameInterface
{
    private BlackjackDeck $deck;
    private BlackjackYourPlayer $you;
    private BlackjackDealer $dealer;
    private BlackjackJudge $judge;
    private BlackjackPlayerHandFixer $playerHandFixer;
    private BlackjackScoreCalculator $scoreCalculator;

    public function start(): void
    {
        $this->deck = new BlackjackDeck();
        $this->you = new BlackjackYourPlayer('あなた');
        $this->dealer = new BlackjackDealer('ディーラー');

        // プレーヤーに2枚カードを配る
        $yourCard1 = $this->you->drawCard($this->deck);
        $this->you->showDrawnCard($yourCard1);

        $yourCard2 = $this->you->drawCard($this->deck);
        $this->you->showDrawnCard($yourCard2);
        echo PHP_EOL;

        // ディーラーに2枚カードを配る
        $dealerCard1 = $this->dealer->drawCard($this->deck);
        $this->dealer->showDrawnCard($dealerCard1);

        $dealerCard2 = $this->dealer->drawCard($this->deck);
        echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;
        echo PHP_EOL;

        $this->playerHandFixer = new BlackjackPlayerHandFixer();
        $this->scoreCalculator = new BlackjackScoreCalculator();

        // プレーヤーの得点を確定する
        $this->playerHandFixer->fixHand($this->you, $this->scoreCalculator, $this->deck);

        $this->dealer->showSecondCard($dealerCard2);

        // ディーラーの得点を確定する
        $dealerScore = $this->scoreCalculator->calculateScore($this->dealer->getCards());
        $dealerHand = new BlackjackHand(false, $dealerScore);
        $this->dealer->setHand($dealerHand);
        if (!$this->isPlayerBust($this->you)) {
            $this->playerHandFixer->fixHand($this->dealer, $this->scoreCalculator, $this->deck);
        }

        // プレーヤーとディーラーの得点を表示する
        $this->showPlayersScore($this->you, $this->dealer);
        echo PHP_EOL;

        // 勝敗を判定する
        $this->judge = new BlackjackJudge();
        $results = $this->judge->judgeWinner([$this->you], $this->dealer);
        $this->showResult($results);
        echo 'ブラックジャックを終了します。' . PHP_EOL;
    }

    private function isPlayerBust(BlackjackYourPlayer $you): bool
    {
        return $you->getHand()->getIsBust();
    }

    private function showPlayersScore(BlackjackYourPlayer $you, BlackjackDealer $dealer): void
    {
        echo $you->getName() . 'の得点は' . $you->getHand()->getScore() . 'です。' . PHP_EOL;
        echo $dealer->getName() . 'の得点は' . $dealer->getHand()->getScore() . 'です。' . PHP_EOL;
    }

    /**
     * @param array<string, string> $results
     */
    private function showResult(array $results): void
    {
        foreach ($results as $player => $result) {
            if ($result === 'win') {
                echo $player . 'の' . $result . 'です！' . PHP_EOL;
            } elseif ($result === 'lose') {
                echo $player . 'の' . $result . 'です。' . PHP_EOL;
            } elseif ($result === 'draw') {
                echo $player . 'は' . $result . 'です。' . PHP_EOL;
            }
        }
    }
}
