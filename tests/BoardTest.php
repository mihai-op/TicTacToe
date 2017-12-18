<?php

use TicTacToe\Board;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase {

    public function testWinOnFirstColumn() {

        $board = new Board;

        $board->mark(0,0, 'X');
        $board->mark(1,1, 'O');
        $board->mark(0,1, 'X');
        $board->mark(1,2, 'O');
        $board->mark(0,2, 'X');

        $this->assertEquals($board->winOnCols(), true);
        $this->assertEquals($board->getWinningSymbol(), 'X');
    }

    public function testWinOnFirstRow() {

        $board = new Board;

        $board->mark(0,0, 'X');
        $board->mark(1,1, 'O');
        $board->mark(1,0, 'X');
        $board->mark(1,2, 'O');
        $board->mark(2,0, 'X');

        $this->assertEquals($board->winOnRows(), true);
        $this->assertEquals($board->getWinningSymbol(), 'X');
    }

    public function testWinOnFirstDiagonal() {

        $board = new Board;

        $board->mark(0,0, 'X');
        $board->mark(0,1, 'O');
        $board->mark(1,1, 'X');
        $board->mark(1,2, 'O');
        $board->mark(2,2, 'X');

        $this->assertEquals($board->winOnFirstDiag(), true);
        $this->assertEquals($board->winonDiagonals(), true);
        $this->assertEquals($board->getWinningSymbol(), 'X');
    }

    public function testWinOnSecondDiagonal() {

        $board = new Board;

        $board->mark(0,0, 'X');
        $board->mark(0,2, 'O');
        $board->mark(1,0, 'X');
        $board->mark(1,1, 'O');
        $board->mark(0,1, 'X');
        $board->mark(2,0, 'O');

        $this->assertEquals($board->winOnSecondDiag(), true);
        $this->assertEquals($board->winonDiagonals(), true);
        $this->assertEquals($board->getWinningSymbol(), 'O');
    }

    public function testDraw() {
        $board = new Board;

        $board->mark(1,1, 'O');
        $board->mark(0,0, 'X');
        $board->mark(2,2, 'O');
        $board->mark(0,2, 'X');
        $board->mark(0,1, 'O');
        $board->mark(2,1, 'X');
        $board->mark(1,0, 'O');
        $board->mark(1,2, 'X');
        $board->mark(2,0, 'O');

        $this->assertEquals($board->checkForDraw(), true);
        $this->assertEquals($board->getWinningSymbol(), null);
    }
}
