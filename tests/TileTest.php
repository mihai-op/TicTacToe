<?php
declare(strict_types=1);

use TicTacToe\Exception\ArgumentOutOfRangeException;
use TicTacToe\Tile;
use PHPUnit\Framework\TestCase;

class TileTest extends TestCase {

    /**
     * @test
     * */
    public function underflow_error_on_row_and_overflow_on_column() {
        $this->expectException(ArgumentOutOfRangeException::class);
        $this->expectExceptionMessage(
            "Row -1 underflows the allowed 0-2 interval." .
            "Column 3 overflows the allowed 0-2 interval."
        );
        $tile = new Tile(-1,3);
    }
}
