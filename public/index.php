<?php

include dirname(__FILE__) . './../vendor/autoload.php';

use TicTacToe\Game;

$game = new Game;


for($row = 0; $row < 3; $row++) {
    for($col = 0; $col < 3; $col++) {
        $game->mark($row, $col);
    }
}

$game->displayBoard();
$game->clearBoard();
$game->displayBoard();


for($row = 0; $row < 3; $row++) {
    for($col = 0; $col < 3; $col++) {
        $game->mark($col, $row); //switching X's and O's
    }
}

$game->displayBoard();
$game->clearBoard();


