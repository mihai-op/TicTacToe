<?php

use TicTacToe\Board;
use TicTacToe\Tile;
use PHPUnit\Framework\TestCase;
use TicTacToe\Exception\ArgumentOutOfRangeException;

class BoardTest extends TestCase {
    /**
     * @test
     */
    public function fill_and_test_for_full() {
        $board = new Board;

        for($row = 0; $row < 3; $row++) {
            for($col = 0; $col < 3; $col++) {
                $board->mark(new Tile($row, $col), 'X');
            }
        }

        $this->assertTrue($board->isFull());
    }

    /**
     * @test
     */
    public function get_negative_row() {
        $board = new Board;

        $this->expectException(ArgumentOutOfRangeException::class);
        $board->getRow(-1);
    }

    /**
     * @test
     */
    public function get_row_larger_than_board_size() {
        $board = new Board;

        $this->expectException(ArgumentOutOfRangeException::class);
        $board->getRow(3);
    }

    /**
     * @test
     */
    public function get_negative_column() {
        $board = new Board;

        $this->expectException(ArgumentOutOfRangeException::class);
        $board->getColumn(-1);
    }

    /**
     * @test
     */
    public function get_column_larger_than_board_size() {
        $board = new Board;

        $this->expectException(ArgumentOutOfRangeException::class);
        $board->getColumn(3);
    }

    /**
     * @test
     */
    public function test_empty_cell_with_wrong_index() {
        $board = new Board;

        $this->expectException(ArgumentOutOfRangeException::class);
        $returnValue = $board->isTileEmpty(new Tile(-1, 0));
    }


    /**
     * @test
     */
    public function mark_with_wrong_index() {
        $board = new Board;

        $this->expectException(ArgumentOutOfRangeException::class);
        $board->mark(new Tile(-1,0), 'X');
    }

    /**
     * @test
     */
    public function mark_and_verify_first_row() {
        $board = new Board;

        $board->mark(new Tile(0,0), 'X');
        $board->mark(new Tile(0,1), 'O');
        $board->mark(new Tile(0,2), 'X');

        $firstRow = $board->getRow(0);

        $this->assertEquals(['X','O','X'], $firstRow);
    }

    /**
     * @test
     */
    public function mark_and_verify_first_column() {
        $board = new Board;

        $board->mark(new Tile(0,0), 'X');
        $board->mark(new Tile(1,0), 'O');
        $board->mark(new Tile(2,0), 'X');

        $firstColumn = $board->getColumn(0);

        $this->assertEquals(['X','O','X'], $firstColumn);
    }

    /**
     * @test
     */
    public function mark_and_verify_main_diagonal() {
        $board = new Board;

        $board->mark(new Tile(0,0), 'X');
        $board->mark(new Tile(1,1), 'O');
        $board->mark(new Tile(2,2), 'X');

        $mainDiag = $board->getMainDiagonal();

        $this->assertEquals(['X','O','X'], $mainDiag);
    }

    /**
     * @test
     */
    public function mark_and_verify_secondary_diagonal() {
        $board = new Board;

        $board->mark(new Tile(0,2), 'X');
        $board->mark(new Tile(1,1), 'O');
        $board->mark(new Tile(2,0), 'X');

        $secondaryDiagonal = $board->getSecondaryDiagonal();
        $this->assertEquals(['X','O','X'], $secondaryDiagonal);
    }
}
