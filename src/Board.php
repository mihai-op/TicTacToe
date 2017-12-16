<?php

namespace TicTacToe;

class Board {
    private $table;

    public function __construct($table = null) {
        if(!isset($table)) {
            $this->clear();
        }
    }

    public function clear()
    {
        for($row = 0; $row < 3; $row++) {
            for($col = 0; $col < 3; $col++) {
                $this->table[$row][$col] = null;
            }
        }
    }

    public function markOnBoard($vertical, $horizontal, $symbol) {
        if($this->table[$horizontal][$vertical] == null && $this->notFull()) {
            $this->table[$horizontal][$vertical] = $symbol;
        }
    }

    public function notFull() {
        for($row = 0; $row < 3; $row++) {
            for($col = 0; $col < 3; $col++) {
                if($this->table[$row][$col] == null) {
                    return true;
                }
            }
        }

        return false;
    }

    public function display() {
        for($row = 0; $row < 3; $row++) {
            for($col = 0; $col < 3; $col++) {
                if($this->table[$row][$col] == null) {
                    echo ". ";
                    continue;
                }

                echo $this->table[$row][$col] . " ";
            }

            echo "\n";
        }
    }
}
