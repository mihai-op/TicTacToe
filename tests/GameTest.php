<?php

use PHPUnit\Framework\TestCase;
use TicTacToe\Game;

class GameTest extends TestCase {

    /**
     * @test
     */
    public function turn_for_second_player_during_first_3_moves() {
        $game = new Game('X');

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
        $game = new Game('X');

        for($index = 0; $index < 7; $index++) {
            $game->markOnBoard($index / 3, $index % 3);
        }

        $this->assertFalse($game->winOnRows());
        $this->assertFalse($game->winOnCols());
        $this->assertFalse($game->winOnMainDiagonal());
        $this->assertTrue($game->winOnSecondaryDiagonal());
        $this->assertEquals('X', $game->winner()->getSymbol());
    }

    /**
     * @test
     */
    public function win_for_o() {
        $game = new Game('O'); 

        for($index = 0; $index < 7; $index++) {
            $game->markOnBoard($index / 3, $index % 3);
        }

        $this->assertFalse($game->winOnRows());
        $this->assertFalse($game->winOnCols());
        $this->assertFalse($game->winOnMainDiagonal());
        $this->assertTrue($game->winOnSecondaryDiagonal());
        $this->assertEquals('O', $game->winner()->getSymbol());
    }

    /**
     * @test
     */
    public function win_on_first_row() {
        $game = new Game('X');

        $game->markOnBoard(0,0);
        $game->markOnBoard(1,1);
        $game->markOnBoard(0,1);
        $game->markOnBoard(1,2);
        $game->markOnBoard(0,2);

        $this->assertTrue($game->winOnRows());
        $this->assertEquals('X', $game->winner()->getSymbol());
    }

    /**
     * @test
     */
    public function win_on_first_column() {

        $game = new Game('X');

        $game->markOnBoard(0,0);
        $game->markOnBoard(1,1);
        $game->markOnBoard(1,0);
        $game->markOnBoard(1,2);
        $game->markOnBoard(2,0);

        $this->assertTrue($game->winOnCols());
        $this->assertEquals('X', $game->winner()->getSymbol());
    }

    /**
     * @test
     */
    public function win_on_main_diagonal() {
        $game = new Game('X');

        $game->markOnBoard(0,0);
        $game->markOnBoard(0,1);
        $game->markOnBoard(1,1);
        $game->markOnBoard(1,2);
        $game->markOnBoard(2,2);

        $this->assertTrue($game->winOnMainDiagonal());
        $this->assertTrue($game->winOnDiagonals());
        $this->assertEquals('X', $game->winner()->getSymbol());
    }

    /**
     * @test
     */
    public function win_on_secondary_diagonal() {

        $game = new Game('X');

        $game->markOnBoard(0,2);
        $game->markOnBoard(0,1);
        $game->markOnBoard(1,1);
        $game->markOnBoard(1,2);
        $game->markOnBoard(2,0);

        $this->assertTrue($game->winOnSecondaryDiagonal());
        $this->assertTrue($game->winOnDiagonals());
        $this->assertEquals('X', $game->winner()->getSymbol());
    }
    /**
     * @test
     */
    public function draw_starting_with_x() {
        $game = new Game('X');

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
        $this->assertFalse($game->winOnMainDiagonal());
        $this->assertFalse($game->winOnSecondaryDiagonal());
        $this->assertEquals(null, $game->winner());
    }

    /**
     * @test
     */
    public function draw_starting_with_o() {
        $game = new Game('O');

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
        $this->assertFalse($game->winOnMainDiagonal());
        $this->assertFalse($game->winOnSecondaryDiagonal());
        $this->assertEquals(null, $game->winner());
    }
}
