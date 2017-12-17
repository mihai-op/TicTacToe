<?php

namespace TicTacToe;

class Board {
    private $table;

    public function __construct($table = null) {
        if(!isset($table)) {
            $this->clear();
        }
    }

    public function clear()
    {
        for($row = 0; $row < 3; $row++) {
            for($col = 0; $col < 3; $col++) {
                $this->table[$row][$col] = null;
            }
        }
    }

    public function mark($vertical, $horizontal, $symbol) {
        if($this->table[$horizontal][$vertical] == null && $this->notFull()) {
            $this->table[$horizontal][$vertical] = $symbol;
        }
    }

    public function notFull() {
        for($row = 0; $row < 3; $row++) {
            for($col = 0; $col < 3; $col++) {
                if($this->table[$row][$col] == null) {
                    return true;
                }
            }
        }

        return false;
    }

    public function display() {
        for($row = 0; $row < 3; $row++) {
            for($col = 0; $col < 3; $col++) {
                if($this->table[$row][$col] == null) {
                    echo ". ";
                    continue;
                }

                echo $this->table[$row][$col] . " ";
            }

            echo "\n";
        }
    }

    public function checkForWinner() {
        if($this->winOnRows() || $this->winOnCols() || $this->winOnDiagonals()) {
            return true;
        }
    }

    public function winOnRows() {
        $winningRow = null;

        //check on rows
        for($row = 0; $row < 3; $row++) {
            $referenceSymbol = $this->table[$row][0];

            $winner = true; //assume winner

            for($col = 1; $col < 3; $col++) {
                if($this->table[$row][$col] !== $referenceSymbol) {
                    $winner = false; //refute winner
                }
            }

            if($winner && $referenceSymbol !== null) {
                $winningRow = $row;
            }
        }

        if($winningRow !== null) {
            echo "row\n";
            return true;
        }

        return false;
    }


    public function winOnCols() {
        $winningCol = null;

        //check on cols
        for($col = 0; $col < 3; $col++) {
            $referenceSymbol = $this->table[$col][0];

            $winner = true; //assume winner

            for($row = 1; $row < 3; $row++) {
                if($this->table[$row][$col] !== $referenceSymbol) {
                    $winner = false; //refute winner
                }
            }

            if($winner && $referenceSymbol !== null) {
                $winningCol = $col;
            }
        }

        if($winningCol !== null) {
            echo "col\n";
            return true;
        }

        return false;
    }

    public function winOnDiagonals() {
        return $this->winOnFirstDiag() || $this->winOnSecondDiag();
    }

    public function winOnFirstDiag() {

        $referenceSymbol = $this->table[0][0];
        $winner = true;

        //check first diag
        for($index = 1; $index < 3; $index++) { 
            if($this->table[$index][$index] !== $referenceSymbol) {
                $winner = false;
            }
        }

        if($winner && $referenceSymbol !== null) {
            return true;
        }

        return false;
    }

    public function winOnSecondDiag() {

        $referenceSymbol = $this->table[0][2];
        $winner = true;

        for($index = 1; $index < 3; $index++) { 
            if($this->table[$index][2 - $index] !== $referenceSymbol) {
                $winner = false;
            }
        }

        if($winner && $referenceSymbol !== null) {
            return true;
        }

        return false;
    }
}
