<?php

class GameBox {
    private $memory_game;
    private $lucky_game;
    private $spell_game;

    function setGame($selected_game) {
        switch ($selected_game) {
            case 'memory':
                $this->setupBrainyGame();
                break;
            case 'lucky':
                $this->setupLuckyGame();
                break;
            case 'spell':
                $this->setupSpellMeGame();
                break;
        }
    }

    function setupBrainyGame() {
        $this->memory_game = new Memory();
        $this->memory_game->initGameVariables();
    }

    function setupLuckyGame() {
        $this->lucky_game = new Guessing();
    }

    function setupSpellMeGame() {
        $this->spell_game = new Spelling();
    }
}
?>