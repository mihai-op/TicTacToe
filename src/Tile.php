<?php
declare(strict_types=1);

namespace TicTacToe;
use TicTacToe\Exception\ArgumentOutOfRangeException;

class Tile {
    private $row;
    private $column;

    public function __construct($row, $column) {

        $errorMessage = "";

        if($row < 0) {
            $errorMessage .= "Row $row underflows the allowed 0-2 interval.";
        }

        if($row >= 3) {
            $errorMessage .= "Row $row overflows the allowed 0-2 interval.";
        }

        if($column < 0) {
            $errorMessage .= "Column $column underflows the allowed 0-2 interval.";
        }

        if($column >= 3) {
            $errorMessage .= "Column $column overflows the allowed 0-2 interval.";
        }

        if(strlen($errorMessage) >= 1) {
            throw new ArgumentOutOfRangeException($errorMessage);
        }

        $this->row = $row;
        $this->column = $column;
    }

    public function getRow() {
        return $this->row;
    }
    
    public function getColumn() {
        return $this->column;
    }
}
