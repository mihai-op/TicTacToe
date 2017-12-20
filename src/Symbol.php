<?php
declare(strict_types=1);

namespace TicTacToe;

class Symbol {
    private $value;

    public function __construct($value) {
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }

    public function equals(Symbol $otherSymbol) {
        return $this->value === $otherSymbol->getValue();
    }
}
