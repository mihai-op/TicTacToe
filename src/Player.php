<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Symbol;
use TicTacToe\Tile;
use TicTacToe\Game;

class Player {
    private $symbol;
    private $game;
    private $tileDecision;

    public function __construct() {
        //nothing here yet
    }

    public function setSymbol(Symbol $symbol) {
        $this->symbol = $symbol;
    }

    public function getSymbol() : Symbol {
        return $this->symbol;
    }

    public function setGame(Game $game) {
        $this->game = $game;
    }

    public function getGame() : Game {
        return $this->game;
    }

    public function setTileDecision(Tile $tile) {
        $this->tileDecision = $tile;
    }

    public function getTileDecision() : Tile {
        return $this->tileDecision;
    }
}
