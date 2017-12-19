<?php

namespace TicTacToe;
use TicTacToe\Exception\WrongSymbolException;

class Game {
    private $board;
    private $players;
    private $playerAtTurn;
    private $winningSymbol;

    public function __construct($startingSymbol) {
        $this->board = new Board;
        $this->players = [new Player('X'), new Player('O')];

        if($startingSymbol === 'X') {
            $this->playerAtTurn = $this->players[0];
        }
        else if($startingSymbol === 'O') {
            $this->playerAtTurn = $this->players[1];
        }
        else {
            throw new WrongSymbolException(
                "Can only start with X or O."
            );
        }
    }

    public function getPlayerAtTurn() {
        return $this->playerAtTurn;
    }

    public function markOnBoard($row, $col) {
        $currentPlayer = $this->playerAtTurn;

        if($this->board->isCellEmpty($row, $col))  {
            $this->board->mark($row, $col, $currentPlayer->getSymbol());

            if($this->isVictory()) {
                $this->winningSymbol = $currentPlayer->getSymbol();
            }
            if($this->playerAtTurn->getSymbol() === 'X') {
                $this->playerAtTurn = $this->players[1];
            }
            else {
                $this->playerAtTurn = $this->players[0];
            }
        }
    }

    public function winner() {
        if($this->isXWinner()) {
            return $this->players[0];
        }

        if($this->isOWinner()) {
            return $this->players[1];
        }

        return null;
    }

    private function isVictory() {
        return $this->winOnRows() || $this->winOnCols() || $this->winOnDiagonals();
    }

    private function isXWinner() {
        return $this->isVictory() && ($this->getWinningSymbol() === 'X');
    }

    private function isOWinner() {
        return $this->isVictory() && ($this->getWinningSymbol() === 'O');
    }

    private function isDraw() {
        return $this->board->isFull() && !$this->isVictory();
    }

    private function winOnMainDiagonal() {
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

    private function winOnSecondaryDiagonal() {
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

    private function winOnDiagonals() {
        return $this->winOnMainDiagonal() || $this->winOnSecondaryDiagonal();
    }


    private function winOnRows() {
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


    private function winOnCols() {
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

    private function getWinningSymbol() {
        return $this->winningSymbol;
    }
}
