<?php

class GameSession {
    private $game_session_id;

    function setGameSessionID($name)
    {
        switch ($name) {
            case "memory":
                $this->game_session_id = random_num(14) . "memory";
                break;
            case "lucky":
                $this->game_session_id = random_num(15) . "lucky";
                break;
            case "spell":
                $this->game_session_id = random_num(15) . "spell";
                break;
        }
    }

    function getGameSessionID() {
        return $this->game_session_id;
    }

    function random_num($length)
    {
        $text = "";
        if ($length < 5) {
            $length = 5;
        }

        $len = rand(4, $length);

        for ($i = 0; $i < $len; $i++) {
            $text .= rand(0, 9);
        }

        return $text;
    }
}

?>