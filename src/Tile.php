<?php

namespace TicTacToe;
use TicTacToe\Exception\ArgumentOutOfRangeException;

class Tile {
    private $row;
    private $column;

    public function __construct($row, $column) {

        if($row < 0 || $row >= 3) {
            throw new ArgumentOutOfRangeException(
                "Invalid row size."
            );
        }

        if($column < 0 || $column >= 3) {
            throw new ArgumentOutOfRangeException(
                "Invalid column size."
            );
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
