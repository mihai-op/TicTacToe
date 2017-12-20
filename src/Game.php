<?php

namespace TicTacToe;

class Game {
    private $board;
    private $players;

    public function __construct($firstPlayer, $secondPlayer, $symbols = ['X','O']) {
        $this->board = new Board;

        $this->players[0] = $firstPlayer;
        $this->players[1] = $secondPlayer;

        $this->players[0]->setGame($this);
        $this->players[1]->setGame($this);

        $this->players[0]->setSymbol($symbols[0]);
        $this->players[1]->setSymbol($symbols[1]);

        $this->playerAtTurn = $this->players[0];
    }


    public function getPlayerAtTurn() {
        return $this->playerAtTurn;
    }

    public function takeTurn($tile) {
        $currentPlayer = $this->playerAtTurn;

        if($this->board->isTileEmpty($tile))  {
            $this->playerAtTurn->markTile($tile, $currentPlayer->getSymbol());

            //I need to find a better way to compare objects
            if($this->playerAtTurn->getSymbol() === $this->players[0]->getSymbol()) {
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
            if($lineStats[$index] === $this->players[0]->getSymbol()) {
                return $this->players[0];
            }
            else if($lineStats[$index] === $this->players[1]->getSymbol()) {
                return $this->players[1];
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
