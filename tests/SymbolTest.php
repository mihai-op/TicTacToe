<?php
declare(strict_types=1);

use PHPUnit\FrameWork\TestCase;

class SymbolTest extends TestCase
{
    /**
     * @test
     * */
    public function get_symbol_for_x_and_o() {
        $symbol = new \TicTacToe\Symbol('X');
        $this->assertEquals('X', $symbol->getValue());

        $symbol = new \TicTacToe\Symbol('O');
        $this->assertEquals('O', $symbol->getValue());
    }
}

