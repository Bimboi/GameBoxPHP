<?php

class GamePlatform {
    private $player;
    private $game;
    private $gameSession;
    private $saveGame;

    function pickGame($selected_game) {
        $this->player = new Player();
        $_SESSION['session_id'] = $this->player->getSessionID();

        $this->game = new GameBox();
        $this->game->setGame($selected_game);
    }

    function recordGame($con, $selected_game, $username, $result) {
        $this->gameSession = new GameSession();
        $this->saveGame = new SaveGame($con);

        switch($selected_game) {
            case 'memory':
                $this->gameSession->setGameSessionID('memory');
                $id = $this->gameSession->getGameSessionID();
                $this->saveGame->memory($username, $id, $_SESSION['attempts'], $result);
                break;
            case 'lucky':
                $this->gameSession->setGameSessionID('lucky');
                $id = $this->gameSession->getGameSessionID();
                $this->saveGame->lucky( $username, $id, $_SESSION['attempts'], $result);
                break;
            case 'spell':
                $this->gameSession->setGameSessionID('spell');
                $id = $this->gameSession->getGameSessionID();
                $this->saveGame->spell( $username, $id, $_SESSION['difficulty'], $_SESSION['time_spent'], $result);
                break;
        }
    }
}
?>