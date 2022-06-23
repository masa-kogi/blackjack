<?php

namespace Blackjack;

require_once 'TwoPlayersBlackjackGame.php';
require_once 'ThreeOrFourPlayersBlackjackGame.php';

echo 'ブラックジャックゲームを開始します。' . PHP_EOL;
echo PHP_EOL;

echo '何名でプレイしますか？(2 or 3 or 4)' . PHP_EOL;
$playerNum = intval(trim(fgets(STDIN)));

while (!isProperNum($playerNum)) {
    echo 'プレイ人数は2,3,4の何れかを入力してください。' . PHP_EOL;
    $playerNum = intval(trim(fgets(STDIN)));
}
$game = getGameType($playerNum);
$game->start();

function getGameType(int $playerNum): BlackjackGameInterface
{
    if ($playerNum === 2) {
        return new TwoPlayersBlackjackGame();
    }
    return new ThreeOrFourPlayersBlackjackGame($playerNum);
}

function isProperNum(int $playerNum): bool
{
    return  in_array($playerNum, [2, 3, 4]);
}
