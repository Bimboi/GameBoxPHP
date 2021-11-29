<?php

class GameSession {
    private $game_session_id;

    function setGameSessionID($name)
    {
        switch ($name) {
            case Constants::brainy_name:
                $this->game_session_id = "memory" . $this->random_num(7);
                break;
            case Constants::lucky_name:
                $this->game_session_id = "lucky" . $this->random_num(8);
                break;
            case Constants::spell_name:
                $this->game_session_id = "spell" . $this->random_num(8);
                break;
        }
    }

    function getGameSessionID() {
        return $this->game_session_id;
    }

    function random_num($length)
    {
        $text = "";

        for ($i = 0; $i < $length; $i++) {
            $text .= rand(0, 9);
        }

        $text .= date('Ymdhis');
        return $text;
    }
}

?>