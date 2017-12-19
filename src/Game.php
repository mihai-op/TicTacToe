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

            if($this->winner() !== null) {
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
        $lineStats = [];

        for($row = 0; $row < 3; $row++) {
            $lineStats[] = $this->sameSymbolOnLine($this->board->getRow($row));
        }

        for($column = 0; $column < 3; $column++) {
            $lineStats[] = $this->sameSymbolOnLine($this->board->getColumn($column));
        }

        $lineStats[] = $this->sameSymbolOnLine($this->board->getMainDiagonal());
        $lineStats[] = $this->sameSymbolOnLine($this->board->getSecondaryDiagonal());

        for($index = 0; $index < count($lineStats); $index++) {
            if($lineStats[$index] === 'X') {
                return $this->players[0];
            }
            else if($lineStats[$index] === 'O') {
                return $this->players[1];
            }
        }

        return null;
    }

    //this function returns NULL both when:
    //$line = [null, null, null]
    //$line = ['X','O','X']
    //might need a fix if it does not work out well
    private function sameSymbolOnLine($line) {
        if(count(array_unique($line)) === 1) {
            return $line[0];
        }

        return null;
    }
}
