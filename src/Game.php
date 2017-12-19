<?php

namespace TicTacToe;

class Game {
    private $board;
    private $players;
    private $turnForSecondPlayer;
    private $winningSymbol;

    public function __construct($turnForSecondPlayer = false) {
        $this->board = new Board;

        $this->players = [new Player('X'), new Player('O')];
        $this->turnForSecondPlayer = $turnForSecondPlayer;
        $this->winningSymbol = null;
    }

    public function getPlayerAtTurn() {
        if($this->turnForSecondPlayer) {
            return $this->players[1];
        }
        return $this->players[0];
    }

    public function markOnBoard($row, $col) {
        $currentPlayer = $this->getPlayerAtTurn();
    
        if( $this->board->isCellEmpty($row, $col) && !$this->isVictory()) {
            $this->board->mark($row, $col, $currentPlayer->getSymbol());
            $this->turnForSecondPlayer = !$this->turnForSecondPlayer;

            if($this->isVictory()) {
                $this->winningSymbol = $currentPlayer->getSymbol();
            }

            return true;
        }

        return false;
    }

    public function isVictory() {
        return $this->winOnRows() || $this->winOnCols() || $this->winOnDiagonals();
    }

    public function isXWinner() {
        return $this->isVictory() && ($this->getWinningSymbol() === 'X');
    }
    public function isOWinner() {
        return $this->isVictory() && ($this->getWinningSymbol() === 'O');
    }

    public static function startsWithO() {
        return new Game(true);
    }
    public function getTurnForSecondPlayer() {
        return $this->turnForSecondPlayer;
    }


    public function isDraw() {
        return $this->board->isFull() && !$this->isVictory();
    }

    public function winOnMainDiagonal() {
        $mainDiagonal = $this->board->getMainDiagonal();

        $referenceSymbol = $mainDiagonal[0];
        $winner = true;

        for($index = 1; $index < 3; $index++) {
            if($mainDiagonal[$index] !== $referenceSymbol) {
                $winner = false;
            }
        }

        if($referenceSymbol !== null) {
            return $winner;
        }

        return false;
    }

    public function winOnSecondaryDiagonal() {
        $secondaryDiag = $this->board->getSecondaryDiagonal();

        $referenceSymbol = $secondaryDiag[0];
        $winner = true;

        for($index = 1; $index < 3; $index++) { 
            if($secondaryDiag[$index] !== $referenceSymbol) {
                $winner = false;
            }
        }

        if($referenceSymbol !== null) {
            return $winner;
        }

        return false;
    }

    public function winOnDiagonals() {
        return $this->winOnMainDiagonal() || $this->winOnSecondaryDiagonal();
    }


    public function winOnRows() {
        $winningRow = null;

        for($row = 0; $row < 3; $row++) {
            $currentRow = $this->board->getRow($row);

            $referenceSymbol = $currentRow[0];

            $winner = true; //assume winner

            for($col = 1; $col < 3; $col++) {
                if($currentRow[$col] !== $referenceSymbol) {
                    $winner = false; //refute winner
                }
            }

            if($winner && $referenceSymbol !== null) {
                $winningRow = $row;
            }
        }

        if($winningRow !== null) {
            return true;
        }

        return false;
    }


    public function winOnCols() {
        $winningCol = null;

        for($col = 0; $col < 3; $col++) {
            $currentCol = $this->board->getColumn($col);
            $referenceSymbol = $currentCol[0];

            $winner = true; //assume winner

            for($row = 1; $row < 3; $row++) {
                if($currentCol[$row] !== $referenceSymbol) {
                    $winner = false; //refute winner
                }
            }

            if($winner && $referenceSymbol !== null) {
                $winningCol = $col;
            }
        }

        if($winningCol !== null) {
            return true;
        }

        return false;
    }

    public function getWinningSymbol() {
        return $this->winningSymbol;
    }
}
