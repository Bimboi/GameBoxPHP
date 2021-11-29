<?php

include_once("Game.php");
include_once("Memory.php");
include_once("Guessing.php");
include_once("Spelling.php");

class GameBox
{
    private $memory_game;
    private $lucky_game;
    private $spell_game;

    private $brainy_name = Constants::brainy_name;
    private $lucky_name = Constants::lucky_name;
    private $spell_name = Constants::spell_name;

    function setGame($selected_game)
    {
        $gameSession = new GameSession();
        switch ($selected_game) {
            case $this->brainy_name:
                $gameSession->setGameSessionID($this->brainy_name);
                $_SESSION['game_session_id'] = $gameSession->getGameSessionID();
                $_SESSION['selected_game'] = $this->brainy_name;
                $this->setupBrainyGame();
                break;
            case $this->lucky_name:
                $gameSession->setGameSessionID($this->lucky_name);
                $_SESSION['game_session_id'] = $gameSession->getGameSessionID();
                $_SESSION['selected_game'] = $this->lucky_name;
                $this->setupLuckyGame();
                break;
            case $this->spell_name:
                $gameSession->setGameSessionID($this->spell_name);
                $_SESSION['game_session_id'] = $gameSession->getGameSessionID();
                $_SESSION['selected_game'] = $this->spell_name;
                $this->setupSpellMeGame();
                break;
        }
    }

    function setupBrainyGame()
    {
        $this->memory_game = new Memory();
        $this->memory_game->initGameVariables();
    }

    function setupLuckyGame()
    {
        $this->lucky_game = new Guessing();
        $this->lucky_game->initGameVariables();
    }

    function setupSpellMeGame()
    {
        $this->spell_game = new Spelling();
        $this->spell_game->initGameVariables();
    }
}
