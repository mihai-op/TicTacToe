<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Player;
use TicTacToe\Symbol;
use TicTacToe\Board;

class Game {
    private $board;
    private $players = [];

    public function __construct(Player $firstPlayer, Player $secondPlayer) {
        $this->board = new Board;

        $firstPlayer->setSymbol(new Symbol('X'));
        $secondPlayer->setSymbol(new Symbol('O'));

        $firstPlayer->setGame($this);
        $secondPlayer->setGame($this);

        $this->players[0] = $firstPlayer;
        $this->players[1] = $secondPlayer;
    }


    public function getPlayerAtTurn() : Player {
        $count = $this->board->countEmptyTiles();

        if($count % 2 == 1) {
            return $this->players[0];
        }

        else {
            return $this->players[1];
        }
    }

    public function winner() {
        $rows = $this->board->getAllRows();
        $columns = $this->board->getAllColumns();
        $mainDiagonal = $this->board->getMainDiagonal();
        $secondaryDiagonal = $this->board->getSecondaryDiagonal();

        $lines = array_merge($rows, $columns, [$mainDiagonal, $secondaryDiagonal]);

        $lineStats = [];

        foreach($lines as $line) {
            $lineStats[] = $this->sameSymbolOnLine($line);
        }

        for($index = 0; $index < count($lineStats); $index++) {
            if($lineStats[$index] === $this->players[0]->getSymbol()->getValue()) {
                return $this->players[0];
            }
            else if($lineStats[$index] === $this->players[1]->getSymbol()->getValue()) {
                return $this->players[1];
            }
        }

        return null;
    }

    public function validateDecision() : bool {
        $decision = $this->getPlayerAtTurn()->getTileDecision();
        return  $decision !== null && $this->board->isTileEmpty($decision);
    }

    public function executeDecision() {

        if($this->validateDecision()) {
            $decision = $this->getPlayerAtTurn()->getTileDecision();
            $symbol = $this->getPlayerAtTurn()->getSymbol();
            $this->board->mark($decision, $symbol);

            return;
        }

        throw new IllegalDecisionException();
    }

    public function getBoard() : Board {
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
