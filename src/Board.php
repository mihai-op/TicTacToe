<?php

namespace TicTacToe;
use TicTacToe\Exception\ArgumentOutOfRangeException;

class Board {
    private $table;

    public function __construct() {
        $this->clear();
    }

    public function clear()
    {
        for($row = 0; $row < 3; $row++) {
            for($col = 0; $col < 3; $col++) {
                $this->table[$row][$col] = null;
            }
        }

        return true;
    }
    
    public function getTable() {
        return $this->table;
    }

    public function getRow($rowIndex) {
        if($rowIndex < 0 || $rowIndex >= 3) {
            throw new ArgumentOutOfRangeException("Invalid row.");
        }

        $rowArray = $this->table[$rowIndex];
        return $rowArray;
    }

    public function getColumn($columnIndex) {
        if($columnIndex < 0 || $columnIndex >= 3) {
            throw new ArgumentOutOfRangeException("Invalid column.");
        }

        $columnArray = [];

        for($rowIndex = 0; $rowIndex < 3; $rowIndex++) {
            $columnArray[] = $this->table[$rowIndex][$columnIndex];
        }

        return $columnArray;
    }

    public function getMainDiagonal() {
        $diagonalArray = [];

        for($index = 0; $index < 3; $index++) {
            $diagonalArray[] = $this->table[$index][$index];
        }

        return $diagonalArray;
    }

    public function getSecondaryDiagonal() {
        $diagonalArray = [];

        for($index = 0; $index < 3; $index++) {
            $diagonalArray[] = $this->table[$index][2 - $index];
        }

        return $diagonalArray;
    }
    
    public function isFull() {
        for($rowIndex = 0; $rowIndex < 3; $rowIndex++) {
            for($columnIndex = 0; $columnIndex < 3; $columnIndex++) {
                if($this->table[$rowIndex][$columnIndex] == null) {
                    return false;
                }
            }
        }

        return true;
    }

    public function isCellEmpty($rowIndex, $columnIndex) {
        if($rowIndex < 0 || $rowIndex >= 3 || 
            $columnIndex < 0 || $columnIndex >= 3) {
            throw new ArgumentOutOfRangeException("Invalid row or column.");
        }

        return $this->table[$rowIndex][$columnIndex] == null;
    }

    public function mark($row, $col, $symbol) {
        if($row >= 0 && $row < 3 && $col >= 0 && $col < 3) {
            $this->table[$row][$col] = $symbol;
            return true;
        }

        throw new ArgumentOutOfRangeException("Invalid row or column.");
    }
}
