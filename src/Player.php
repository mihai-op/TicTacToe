<?php

namespace TicTacToe;

class Player {
    private $symbol;
    private $game;

    public function __construct() {
        //nothing here yet
    }

    public function setSymbol(\TicTacToe\Symbol $symbol) {
        $this->symbol = $symbol;
    }

    public function getSymbol() {
        return $this->symbol;
    }

    public function getGame() {
        return $this->game;
    }

    public function setGame(\TicTacToe\Game $game) {
        $this->game = $game;
    }

    public function markTile($row, $column) {
        $this->game->getBoard()->mark($row, $column, $this->symbol);
    }
}
