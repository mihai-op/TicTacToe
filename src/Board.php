<?php

namespace TicTacToe;

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

    public function getRow($row) {
        return $this->table[$row];
    }

    public function getColumn($col) {
        $column = [];

        for($row = 0; $row < 3; $row++) {
            $column[] = $this->table[$row][$col];
        }

        return $column;
    }

    public function getMainDiag() {
        $diag = [];

        for($index = 0; $index < 3; $index++) {
            $diag[] = $this->table[$index][$index];
        }

        return $diag;
    }

    public function getSecondDiag() {
        $diag = [];

        for($index = 0; $index < 3; $index++) {
            $diag[] = $this->table[$index][2 - $index];
        }

        return $diag;
    }
    
    public function isFull() {
        for($row = 0; $row < 3; $row++) {
            for($col = 0; $col < 3; $col++) {
                if($this->table[$row][$col] == null) {
                    return false;
                }
            }
        }

        return true;
    }

    public function isCellEmpty($row, $col) {
        return $this->table[$row][$col] == null;
    }

    public function mark($row, $col, $symbol) {
        if($row >= 0 && $row < 3 && $col >= 0 && $col < 3) {
            $this->table[$row][$col] = $symbol;
            return true;
        }

        return false;
    }
}
