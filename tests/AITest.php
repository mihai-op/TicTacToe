<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TicTacToe\Game;
use TicTacToe\Player;
use TicTacToe\Symbol;
use TicTacToe\Tile;
use TicTacToe\AI;
use TicTacToe\Human; //I don't know if I need it

class AITest extends TestCase {

    /**
     * @test
     * */
    public function AI_vs_AI() {
        $player1 = new AI();
        $player2 = new AI();

        $game = new Game($player1, $player2);

        for($count = 0; $count < 9; $count++) {
            //executes a fully automated decision process
            $game->executeDecision();
        }

        //does not check if there is a winner
        $this->assertEquals(0, count($game->getBoard()->getAvailableTiles()));
    }
}
