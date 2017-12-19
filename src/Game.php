<?php

namespace TicTacToe;
use TicTacToe\Exception\WrongSymbolException;

class Game {
    private $board;
    private $firstPlayer;
    private $secondPlayer;

    private $playerAtTurn;

    public function __construct($firstPlayer, $secondPlayer, $symbols = ['X','O']) {
        $this->board = new Board;

        $this->firstPlayer = $firstPlayer;
        $this->secondPlayer = $secondPlayer;

        $this->firstPlayer->setGame($this);
        $this->secondPlayer->setGame($this);

        $this->firstPlayer->setSymbol($symbols[0]);
        $this->secondPlayer->setSymbol($symbols[1]);

        $this->playerAtTurn = $firstPlayer;
    }


    public function getPlayerAtTurn() {
        return $this->playerAtTurn;
    }

    public function takeTurn($row, $column) {
        $currentPlayer = $this->playerAtTurn;

        if($this->board->isCellEmpty($row, $column))  {
            $this->playerAtTurn->markTile($row, $column, $currentPlayer->getSymbol());

            //I need to find a better way to compare objects
            if($this->playerAtTurn->getSymbol() === $this->firstPlayer->getSymbol()) {
                $this->playerAtTurn = $this->secondPlayer;
            }
            else {
                $this->playerAtTurn = $this->firstPlayer;
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
            if($lineStats[$index] === $this->firstPlayer->getSymbol()) {
                return $this->firstPlayer;
            }
            else if($lineStats[$index] === $this->secondPlayer->getSymbol()) {
                return $this->secondPlayer;
            }
        }

        return null;
    }


    public function getBoard() {
        return $this->board;
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
