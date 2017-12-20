<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Exception\WrongSymbolException;

class Symbol {
    private $value;

    public function __construct(string $value) {
        if($value !== 'X' && $value !== 'O') {
            throw new WrongSymbolException(
                "$value cannot be used for a symbol" .
                "Only X or O can be used for a symbol"
            );
        }

        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }

    public function equals(Symbol $otherSymbol) {
        return $this->value === $otherSymbol->getValue();
    }
}
