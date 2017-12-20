<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Symbol;
use TicTacToe\Tile;
use TicTacToe\Game;

class Player {
    private $symbol;
    private $game;

    public function __construct() {
        //nothing here yet
    }

    public function setSymbol(Symbol $symbol) {
        $this->symbol = $symbol;
    }

    public function getSymbol() {
        return $this->symbol;
    }

    public function getGame() {
        return $this->game;
    }

    public function setGame(Game $game) {
        $this->game = $game;
    }

    public function markTile(Tile $tile) {
        $this->game->getBoard()->mark($tile, $this->symbol);
    }
}
