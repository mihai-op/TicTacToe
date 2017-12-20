<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Tile;
use TicTacToe\Symbol;
use TicTacToe\Exception\ArgumentOutOfRangeException;

class Board {
    private $table = [];

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

    public function getAllRows() {
        $rows = [];

        for($index = 0; $index < 3; $index++) {
            $rows[] = $this->getRow($index);
        }

        return $rows;
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

    public function getAllColumns() {
        $columns = [];

        for($index = 0; $index < 3; $index++) {
            $columns[] = $this->getRow($index);
        }

        return $columns;
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

    public function isTileEmpty(Tile $tile) {
        return $this->table[$tile->getRow()][$tile->getColumn()] == null;
    }

    public function countEmptyTiles() {
        $count = 0;

        for($rowIndex = 0; $rowIndex < 3; $rowIndex++) {
            for($columnIndex = 0; $columnIndex < 3; $columnIndex++) {
                if($this->isTileEmpty(new Tile($rowIndex, $columnIndex))) {
                    $count++;
                }
            }
        }

        return $count;
    }

    public function getAvailableTiles(): array {
        $tiles = [];

        for($row = 0; $row < 3; $row++) {
            for($column = 0; $column < 3; $column++) {
                $tile = new Tile($row, $column);

                if($this->isTileEmpty($tile)) {
                    $tiles[] = $tile;
                }
            }
        }

        return $tiles;
    }

    public function mark(Tile $tile, Symbol $symbol) {
        $this->table[$tile->getRow()][$tile->getColumn()] = $symbol->getValue();
    }
}
