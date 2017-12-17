<?php

include dirname(__FILE__) . './../vendor/autoload.php';

use TicTacToe\Game;

$game = new Game;

echo "\nFill on rows\n";
for($row = 0; $row < 3; $row++) {
    for($col = 0; $col < 3; $col++) {
        $game->markOnBoard($row, $col);
    }
}

$game->displayBoard();

echo "\nDisplay clear board\n";
$game->clearBoard();
$game->displayBoard();


echo "\nFill on cols\n";
for($row = 0; $row < 3; $row++) {
    for($col = 0; $col < 3; $col++) {
        $game->markOnBoard($col, $row); //switching X's and O's
    }
}

$game->displayBoard();
$game->clearBoard();

