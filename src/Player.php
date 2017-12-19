<?php

namespace TicTacToe;

class Player {
    private $symbol;
    private $game;

    public function __construct() {
        //nothing here yet
    }

    public function setSymbol($symbol) {
        $this->symbol = $symbol;
    }

    public function getSymbol() {
        return $this->symbol;
    }

    public function getGame($game) {
        return $this->game;
    }

    public function setGame($game) {
        $this->game = $game;
    }

    public function markTile($row, $column) {
        $this->game->getBoard()->mark($row, $column, $this->symbol);
    }
}
