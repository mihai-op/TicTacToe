<?php

namespace TicTacToe;

class Game {
    private $board;
    private $players;
    private $turnForO;

    public function __construct() {
        $this->board = new Board;

        $this->players = [new Player('X'), new Player('O')];
        $this->turnForO = false;
    }

    public function getPlayerAtTurn() {
        if($this->turnForO) {
            return $this->players[1];
        }
        return $this->players[0];
    }

    public function markOnBoard($row, $col) {
        $currentPlayer = $this->getPlayerAtTurn();
    
        if( $this->board->notFull() && !$this->board->checkForWinner()) {
            $this->board->mark($row, $col, $currentPlayer->getSymbol());
            $this->turnForO = !$this->turnForO;

            return;
        }

        echo "Cannot mark anymore.\n";
    }


    public function displayBoard() {
        $this->board->display();
    }

    public function clearBoard() {
        $this->board->clear();
    }

}
