<?php

use PHPUnit\Framework\TestCase;
use TicTacToe\Player;

class PlayerTest extends TestCase {
    /**
     * @test
     */
    public function verify_symbol_assignation() {
        $player0 = new Player('X');
        $player1 = new Player('O');

        $this->assertEquals('X', $player0->getSymbol());
        $this->assertEquals('O', $player1->getSymbol());
    }
}
