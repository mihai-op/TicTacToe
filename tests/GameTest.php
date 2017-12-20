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

        $game->getPlayerAtTurn()->setTileDecision(new Tile(1,1));
        $this->assertTrue($game->validateDecision());
        $game->executeDecision();

        $game->getPlayerAtTurn()->setTileDecision(new Tile(0,0));
        $this->assertTrue($game->validateDecision());
        $game->executeDecision();

        $game->getPlayerAtTurn()->setTileDecision(new Tile(2,2));
        $this->assertTrue($game->validateDecision());
        $game->executeDecision();
    }

    /**
     * @test
     */
    public function win_for_first_player() {
        $game = &$this->game;

        for($index = 0; $index < 7; $index++) {
            $game->getPlayerAtTurn()->setTileDecision(new Tile((int) ($index / 3), (int) ($index % 3)));
            $this->assertTrue($game->validateDecision());
            $game->executeDecision();
        }

        $this->assertTrue($game->winner()->getSymbol()->equals(new Symbol('X')));
    }

    /**
     * @test
     */
    public function test_draw() {
        $game = &$this->game;

        $moveList = [[1,1],[0,0],[2,2],[0,2],[0,1],[2,1],[1,0],[1,2],[2,0]];
        
        foreach($moveList as $move) {
            $game->getPlayerAtTurn()->setTileDecision(new Tile($move[0], $move[1]));
            $this->assertTrue($game->validateDecision());
            $game->executeDecision();
        }

        $this->assertEquals(null, $game->winner());
    }

    /**
     * @test
     */
    public function win_for_second_player() {
        $game = &$this->game;

        $moveList = [[0,1],[0,0],[1,2],[1,1],[2,1],[2,2]];

        foreach($moveList as $move) {
            $game->getPlayerAtTurn()->setTileDecision(new Tile($move[0], $move[1]));
            $this->assertTrue($game->validateDecision());
            $game->executeDecision();
        }

        $this->assertTrue($game->winner()->getSymbol()->equals(new Symbol('O')));
    }
}
