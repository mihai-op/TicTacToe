<?php

use PHPUnit\Framework\TestCase;
use TicTacToe\Game;
use TicTacToe\Player;
use TicTacToe\Tile;

class GameTest extends TestCase {
    public $game;
    public $players;

    public function setUp() {

        //using implicit symbols ['X','O']
        $this->game = new Game(new Player(), new Player());
    }

    /**
     * @test
     * */
    public function start_a_game() {
        $game = &$this->game;

        $this->assertEquals('X', $game->getPlayerAtTurn()->getSymbol());
    }

    /**
     * @test
     */
    public function player_at_turn_during_first_3_moves() {
        $game = &$this->game;

        $this->assertEquals('X', $game->getPlayerAtTurn()->getSymbol());
        $this->game->takeTurn(new Tile(1,1));
        $this->assertEquals('O', $game->getPlayerAtTurn()->getSymbol());
        $this->game->takeTurn(new Tile(0,0));
        $this->assertEquals('X', $game->getPlayerAtTurn()->getSymbol());
        $this->game->takeTurn(new Tile(2,2));
        $this->assertEquals('O', $game->getPlayerAtTurn()->getSymbol());
    }

    /**
     * @test
     */
    public function win_for_first_player() {
        $game = &$this->game;

        for($index = 0; $index < 7; $index++) {
            $game->takeTurn(new Tile($index / 3, $index % 3));
        }

        $this->assertEquals('X', $game->winner()->getSymbol());
    }

    /**
     * @test
     */
    public function test_draw() {
        $game = &$this->game;

        $game->takeTurn(new Tile(1,1));
        $game->takeTurn(new Tile(0,0));
        $game->takeTurn(new Tile(2,2));
        $game->takeTurn(new Tile(0,2));
        $game->takeTurn(new Tile(0,1));
        $game->takeTurn(new Tile(2,1));
        $game->takeTurn(new Tile(1,0));
        $game->takeTurn(new Tile(1,2));
        $game->takeTurn(new Tile(2,0));

        $this->assertEquals(null, $game->winner());
    }

    /**
     * @test
     */
    public function win_for_second_player() {
        $game = &$this->game;

        $game->takeTurn(new Tile(0,1));
        $game->takeTurn(new Tile(0,0));
        $game->takeTurn(new Tile(1,2));
        $game->takeTurn(new Tile(1,1));
        $game->takeTurn(new Tile(2,1));
        $game->takeTurn(new Tile(2,2));

        $this->assertEquals('O', $game->winner()->getSymbol());
    }

    /**
     * @test
     * */
    public function reverse_player_order() {
        $game = new Game(new Player(), new Player(), ['O','X']);

        for($index = 0; $index < 7; $index++) {
            $game->takeTurn(new Tile($index / 3, $index % 3));
        }

        //O should win (first player)
        $this->assertEquals('O', $game->winner()->getSymbol());
    }
}
