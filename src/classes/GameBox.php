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

    function setGame($selected_game)
    {
        $gameSession = new GameSession();
        switch ($selected_game) {
            case 'memory':
                $gameSession->setGameSessionID('memory');
                $_SESSION['game_session_id'] = $gameSession->getGameSessionID();
                $_SESSION['selected_game'] = "memory";
                $this->setupBrainyGame();
                break;
            case 'lucky':
                $gameSession->setGameSessionID('lucky');
                $_SESSION['game_session_id'] = $gameSession->getGameSessionID();
                $_SESSION['selected_game'] = "lucky";
                $this->setupLuckyGame();
                break;
            case 'spell':
                $gameSession->setGameSessionID('spell');
                $_SESSION['game_session_id'] = $gameSession->getGameSessionID();
                $_SESSION['selected_game'] = "spell";
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
