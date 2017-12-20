<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Symbol;
use TicTacToe\Tile;
use TicTacToe\Game;

class AI extends Player {

    //disallow taking external decisions for AI
    //AI will always be able to take a decision for itself
    public function setTileDecision(Tile $tile) {
        //overriding base class method
        //does not do anything
    }

    public function getTileDecision() : Tile {
        //the algorithm for AI
        //pick ANY random tile available

        $game = $this->getGame();

        $tiles = $game->getBoard()->getAvailableTiles();

        $randomValue = \rand(0, count($tiles) - 1);

        if(count($tiles) === 0) {
            return null;
        }

        return $tiles[$randomValue];
    }
}
