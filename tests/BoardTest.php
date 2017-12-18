<?php

use TicTacToe\Board;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase {

    /**
     * @test
     */
    public function fill_and_test_for_full() {
        $board = new Board;

        for($row = 0; $row < 3; $row++) {
            for($col = 0; $col < 3; $col++) {
                $board->mark($row, $col, 'X');
            }
        }

        $this->assertTrue($board->isFull());
    }

    /**
     * @test
     */
    public function mark_and_verify_first_row() {
        $board = new Board;

        $board->mark(0,0, 'X');
        $board->mark(0,1, 'O');
        $board->mark(0,2, 'X');

        $firstRow = $board->getRow(0);

        $this->assertEquals(['X','O','X'], $firstRow);
    }

    /**
     * @test
     */
    public function mark_and_verify_first_column() {
        $board = new Board;

        $board->mark(0,0, 'X');
        $board->mark(1,0, 'O');
        $board->mark(2,0, 'X');

        $firstColumn = $board->getColumn(0);

        $this->assertEquals(['X','O','X'], $firstColumn);
    }

    /**
     * @test
     */
    public function mark_and_verify_main_diag() {
        $board = new Board;

        $board->mark(0,0, 'X');
        $board->mark(1,1, 'O');
        $board->mark(2,2, 'X');

        $mainDiag = $board->getMainDiag();

        $this->assertEquals(['X','O','X'], $mainDiag);
    }

    /**
     * @test
     */
    public function mark_and_verify_second_diag() {
        $board = new Board;

        $board->mark(0,2, 'X');
        $board->mark(1,1, 'O');
        $board->mark(2,0, 'X');

        $secondDiag = $board->getSecondDiag();

        $this->assertEquals(['X','O','X'], $secondDiag);
    }
}
