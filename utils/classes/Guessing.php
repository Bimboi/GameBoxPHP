<?php

class Guessing extends Game
{
    private $attempt;
    private $answer;
    private $guess;

    function __construct()
    {
        $this->game_name = "lucky";
        $this->attempt = (int) $_SESSION['attempts_lucky'];
        $this->answer = $_SESSION['answer_lucky'];
        $this->guess = $_POST['guess'];
    }

    function initGameVariables()
    {
        $_SESSION['game_name'] = $this->game_name;
        $_SESSION['answer_lucky'] = rand(1, 50);
        $_SESSION['attempts_lucky'] = 1;
    }

    function unsetGameVariables()
    {
        unset($_SESSION['answer_lucky']);
        unset($_SESSION['attempts_lucky']);
    }

    public function checkMatch() {
        if ($this->answer == $this->guess) {
            return "won";
        } else {
            if ($this->answer < $this->guess) {
                return "lower";
            }
            if ($this->answer > $this->guess) {
                return "higher";
            }
    
            if ($this->attempt == 10) {
                return "lost";
                $_SESSION['answer_lucky'] = "Finished";
            }
            $this->attempt += 1;
            $_SESSION['attempts_lucky'] = $this->attempt;
        }
    }
}
