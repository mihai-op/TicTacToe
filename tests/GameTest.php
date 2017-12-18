<?php

use PHPUnit\Framework\TestCase;
use TicTacToe\Game;

class GameTest extends TestCase {

    /**
     * @test
     */
    public function turn_for_second_player_during_first_3_moves() {
        $game = new Game;

        $this->assertFalse($game->getTurnForSecondPlayer());
        $game->markOnBoard(0,0);
        $this->assertTrue($game->getTurnForSecondPlayer());
        $game->markOnBoard(0,1);
        $this->assertFalse($game->getTurnForSecondPlayer());
    }

    /**
     * @test
     */
    public function win_for_x() {
        $game = new Game;

        for($index = 0; $index < 7; $index++) {
            $game->markOnBoard($index / 3, $index % 3);
        }

        $this->assertFalse($game->winOnRows());
        $this->assertFalse($game->winOnCols());
        $this->assertFalse($game->winOnMainDiag());
        $this->assertTrue($game->winOnSecondDiag());
        $this->assertTrue($game->isVictory());
        $this->assertEquals('X', $game->getWinningSymbol());
        $this->assertTrue($game->isXWinner());
    }

    /**
     * @test
     */
    public function win_for_o() {
        $game = Game::startsWithO(); 

        for($index = 0; $index < 7; $index++) {
            $game->markOnBoard($index / 3, $index % 3);
        }

        $this->assertFalse($game->winOnRows());
        $this->assertFalse($game->winOnCols());
        $this->assertFalse($game->winOnMainDiag());
        $this->assertTrue($game->winOnSecondDiag());
        $this->assertTrue($game->isVictory());
        $this->assertEquals('O', $game->getWinningSymbol());
        $this->assertTrue($game->isOWinner());
    }

    /**
     * @test
     */
    public function win_on_first_row() {
        $game = new Game;

        $game->markOnBoard(0,0);
        $game->markOnBoard(1,1);
        $game->markOnBoard(0,1);
        $game->markOnBoard(1,2);
        $game->markOnBoard(0,2);

        $this->assertTrue($game->winOnRows());
        $this->assertEquals('X', $game->getWinningSymbol());
    }

    /**
     * @test
     */
    public function win_on_first_column() {

        $game = new Game;

        $game->markOnBoard(0,0);
        $game->markOnBoard(1,1);
        $game->markOnBoard(1,0);
        $game->markOnBoard(1,2);
        $game->markOnBoard(2,0);

        $this->assertTrue($game->winOnCols());
        $this->assertEquals('X', $game->getWinningSymbol());
    }

    /**
     * @test
     */
    public function win_on_main_diag() {

        $game = new Game;

        $game->markOnBoard(0,0);
        $game->markOnBoard(0,1);
        $game->markOnBoard(1,1);
        $game->markOnBoard(1,2);
        $game->markOnBoard(2,2);

        $this->assertTrue($game->winOnMainDiag());
        $this->assertTrue($game->winOnDiagonals());
        $this->assertEquals('X', $game->getWinningSymbol());
    }

    /**
     * @test
     */
    public function win_on_second_diag() {

        $game = new Game;

        $game->markOnBoard(0,2);
        $game->markOnBoard(0,1);
        $game->markOnBoard(1,1);
        $game->markOnBoard(1,2);
        $game->markOnBoard(2,0);

        $this->assertTrue($game->winOnSecondDiag());
        $this->assertTrue($game->winOnDiagonals());
        $this->assertEquals('X', $game->getWinningSymbol());
    }
    /**
     * @test
     */
    public function draw_starting_with_x() {
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

        $this->assertFalse($game->winOnRows());
        $this->assertFalse($game->winOnCols());
        $this->assertFalse($game->winOnMainDiag());
        $this->assertFalse($game->winOnSecondDiag());
        $this->assertFalse($game->isVictory());
        $this->assertTrue($game->isDraw());
        $this->assertEquals(null, $game->getWinningSymbol());
    }

    /**
     * @test
     */
    public function draw_starting_with_o() {
        $game = Game::startsWithO();

        $game->markOnBoard(1,1);
        $game->markOnBoard(0,0);
        $game->markOnBoard(2,2);
        $game->markOnBoard(0,2);
        $game->markOnBoard(0,1);
        $game->markOnBoard(2,1);
        $game->markOnBoard(1,0);
        $game->markOnBoard(1,2);
        $game->markOnBoard(2,0);

        $this->assertFalse($game->winOnRows());
        $this->assertFalse($game->winOnCols());
        $this->assertFalse($game->winOnMainDiag());
        $this->assertFalse($game->winOnSecondDiag());
        $this->assertFalse($game->isVictory());
        $this->assertTrue($game->isDraw());
        $this->assertEquals(null, $game->getWinningSymbol());
    }
}
