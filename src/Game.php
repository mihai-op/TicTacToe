<?php

namespace TicTacToe;

class Game {
    private $board;
    private $players;
    private $turnForSecondPlayer;

    public function __construct($turnForSecondPlayer = false) {
        $this->board = new Board;

        $this->players = [new Player('X'), new Player('O')];
        $this->turnForSecondPlayer = $turnForSecondPlayer;
    }

    public function getPlayerAtTurn() {
        if($this->turnForSecondPlayer) {
            return $this->players[1];
        }
        return $this->players[0];
    }

    public function markOnBoard($row, $col) {
        $currentPlayer = $this->getPlayerAtTurn();
    
        if( $this->board->notFull() && !$this->board->checkForWinner()) {
            $this->board->mark($row, $col, $currentPlayer->getSymbol());
            $this->turnForSecondPlayer = !$this->turnForSecondPlayer;

            return;
        }
    }

    public function isDraw() {
        return $this->board->checkForDraw();
    }

    public function isVictory() {
        return $this->board->checkForWinner();
    }

    public function isXWinner() {
        return $this->isVictory() && ($this->board->getWinningSymbol() === 'X');
    }
    public function isOWinner() {
        return $this->isVictory() && ($this->board->getWinningSymbol() === 'O');
    }
    public function displayBoard() {
        $this->board->display();
    }

    public function clearBoard() {
        $this->board->clear();
    }

    public function getTurnForSecondPlayer() {
        return $this->turnForSecondPlayer;
    }
}
