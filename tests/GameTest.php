<?php

use PHPUnit\Framework\TestCase;
use TicTacToe\Game;
use TicTacToe\Exception\WrongSymbolException;

class GameTest extends TestCase {

    /**
     * @test
     * */
    public function start_with_x() {
        $game = new Game('X');

        $this->assertEquals('X', $game->getPlayerAtTurn()->getSymbol());
    }
    /**
     * @test
     * */
    public function start_with_o() {
        $game = new Game('O');

        $this->assertEquals('O', $game->getPlayerAtTurn()->getSymbol());
    }

    /**
     * @test
     * */
    public function start_with_illegal_symbol() {
        $this->expectException(WrongSymbolException::class);

        $game = new Game('ZZZ');
    }

    /**
     * @test
     */
    public function player_at_turn_during_first_3_moves() {
        $game = new Game('X');

        $this->assertEquals('X', $game->getPlayerAtTurn()->getSymbol());
        $game->takeTurn(1,1);
        $this->assertEquals('O', $game->getPlayerAtTurn()->getSymbol());
        $game->takeTurn(0,0);
        $this->assertEquals('X', $game->getPlayerAtTurn()->getSymbol());
        $game->takeTurn(2,2);
        $this->assertEquals('O', $game->getPlayerAtTurn()->getSymbol());
    }

    /**
     * @test
     */
    public function win_for_x() {
        $game = new Game('X');

        for($index = 0; $index < 7; $index++) {
            $game->takeTurn($index / 3, $index % 3);
        }

        $this->assertEquals('X', $game->winner()->getSymbol());
    }

    /**
     * @test
     */
    public function win_for_o() {
        $game = new Game('O'); 

        for($index = 0; $index < 7; $index++) {
            $game->takeTurn($index / 3, $index % 3);
        }

        $this->assertEquals('O', $game->winner()->getSymbol());
    }

    /**
     * @test
     */
    public function win_on_first_row() {
        $game = new Game('X');

        $game->takeTurn(0,0);
        $game->takeTurn(1,1);
        $game->takeTurn(0,1);
        $game->takeTurn(1,2);
        $game->takeTurn(0,2);

        $this->assertEquals('X', $game->winner()->getSymbol());
    }

    /**
     * @test
     */
    public function win_on_first_column() {

        $game = new Game('X');

        $game->takeTurn(0,0);
        $game->takeTurn(1,1);
        $game->takeTurn(1,0);
        $game->takeTurn(1,2);
        $game->takeTurn(2,0);

        $this->assertEquals('X', $game->winner()->getSymbol());
    }

    /**
     * @test
     */
    public function win_on_main_diagonal() {
        $game = new Game('X');

        $game->takeTurn(0,0);
        $game->takeTurn(0,1);
        $game->takeTurn(1,1);
        $game->takeTurn(1,2);
        $game->takeTurn(2,2);

        $this->assertEquals('X', $game->winner()->getSymbol());
    }

    /**
     * @test
     */
    public function win_on_secondary_diagonal() {

        $game = new Game('X');

        $game->takeTurn(0,2);
        $game->takeTurn(0,1);
        $game->takeTurn(1,1);
        $game->takeTurn(1,2);
        $game->takeTurn(2,0);

        $this->assertEquals('X', $game->winner()->getSymbol());
    }
    /**
     * @test
     */
    public function draw_starting_with_x() {
        $game = new Game('X');

        $game->takeTurn(1,1);
        $game->takeTurn(0,0);
        $game->takeTurn(2,2);
        $game->takeTurn(0,2);
        $game->takeTurn(0,1);
        $game->takeTurn(2,1);
        $game->takeTurn(1,0);
        $game->takeTurn(1,2);
        $game->takeTurn(2,0);

        $this->assertEquals(null, $game->winner());
    }

    /**
     * @test
     */
    public function draw_starting_with_o() {
        $game = new Game('O');

        $game->takeTurn(1,1);
        $game->takeTurn(0,0);
        $game->takeTurn(2,2);
        $game->takeTurn(0,2);
        $game->takeTurn(0,1);
        $game->takeTurn(2,1);
        $game->takeTurn(1,0);
        $game->takeTurn(1,2);
        $game->takeTurn(2,0);

        $this->assertEquals(null, $game->winner());
    }
}
