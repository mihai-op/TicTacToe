<?php
declare(strict_types=1);

use PHPUnit\FrameWork\TestCase;
use TicTacToe\Exception\WrongSymbolException;

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

    public function get_wrong_symbol() {
        $this->expectException(WrongSymbolException::class);

        $someSymbol = 'Z';
        $this->expectExceptionMessage(
                "$someSymbol cannot be used for a symbol." .
                "Only X or O can be used for a symbol."
            );
        
        $symbol = new \TicTacToe\Symbol($someSymbol);
    }
}

