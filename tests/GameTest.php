<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TicTacToe\Game;
use TicTacToe\Player;
use TicTacToe\Symbol;
use TicTacToe\Tile;

class GameTest extends TestCase {
    public $game;

    public function setUp() {
        $this->game = new Game(new Player(), new Player());
    }

    /**
     * @test
     * */
    public function start_a_game() {
        $game = &$this->game;

        $this->assertTrue($game->getPlayerAtTurn()->getSymbol()->equals(new Symbol('X')));
    }

    /**
     * @test
     */
    public function player_at_turn_during_first_3_moves() {
        $game = &$this->game;

        $this->assertTrue($game->getPlayerAtTurn()->getSymbol()->equals(new Symbol('X')));
        $this->game->takeTurn(new Tile(1,1));
        $this->assertTrue($game->getPlayerAtTurn()->getSymbol()->equals(new Symbol('O')));
        $this->game->takeTurn(new Tile(0,0));
        $this->assertTrue($game->getPlayerAtTurn()->getSymbol()->equals(new Symbol('X')));
        $this->game->takeTurn(new Tile(2,2));
        $this->assertTrue($game->getPlayerAtTurn()->getSymbol()->equals(new Symbol('O')));
    }

    /**
     * @test
     */
    public function win_for_first_player() {
        $game = &$this->game;

        for($index = 0; $index < 7; $index++) {
            $game->takeTurn(new Tile($index / 3, $index % 3));
        }

        $this->assertTrue($game->winner()->getSymbol()->equals(new Symbol('X')));
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

        $this->assertTrue($game->winner()->getSymbol()->equals(new Symbol('O')));
    }
}
