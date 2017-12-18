<?php

use PHPUnit\Framework\TestCase;
use TicTacToe\Game;

class GameTest extends TestCase {
    
    public function testWinForX() {

        $game = new Game;

        for($index = 0; $index < 7; $index++) {
            $game->markOnBoard($index / 3, $index % 3);
        }

        $this->assertTrue($game->isVictory());
        $this->assertTrue($game->isXWinner());
    }

    public function testWinForO() {
        $game = new Game(true);

        for($index = 0; $index < 7; $index++) {
            $game->markOnBoard($index / 3, $index % 3);
        }

        $this->assertTrue($game->isVictory());
        $this->assertTrue($game->isOWinner());
    }
    public function testDrawStartingWithX() {
        $game = new Game;

        $game->markOnBoard(1,1);
        $game->markOnBoard(0,0);
        $game->markOnBoard(2,2);
        $game->markOnBoard(0,2);
        $game->markOnBoard(0,1);
        $game->markOnBoard(2,1);
        $game->markOnBoard(1,0);
        $game->markOnBoard(1,2);
        $game->markOnBoard(2,0);

        $this->assertTrue($game->isDraw());
    }
    public function testDrawStartingWithO() {
        $game = new Game(true);

        $game->markOnBoard(1,1);
        $game->markOnBoard(0,0);
        $game->markOnBoard(2,2);
        $game->markOnBoard(0,2);
        $game->markOnBoard(0,1);
        $game->markOnBoard(2,1);
        $game->markOnBoard(1,0);
        $game->markOnBoard(1,2);
        $game->markOnBoard(2,0);

        $this->assertTrue($game->isDraw());
    }
}
