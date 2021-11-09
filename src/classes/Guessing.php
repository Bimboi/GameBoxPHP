<?php

class Guessing extends Game
{
    private $attempt;
    private $answer;
    private $guess;

    function __construct()
    {
        $this->attempt = isset($_SESSION['attempts']) ? (int) $_SESSION['attempts'] : "";
        $this->answer = isset($_SESSION['answer_lucky']) ? (int) $_SESSION['answer_lucky'] : "";
        $this->guess = isset($_POST['guess']) ? $_POST['guess'] : "";
    }

    function initGameVariables()
    {
        $_SESSION['answer_lucky'] = rand(1, 50);
        $_SESSION['attempts'] = 1;
    }

    function unsetGameVariables()
    {
        unset($_SESSION['answer_lucky']);
        unset($_SESSION['attempts']);
        unset($_POST['guess']);
    }

    public function checkMatch() {
        if (isset($_POST['guess'])) {
            if ($this->attempt > 10) {
                header("Location: lucky_index.php");
                die;
            }
        
            $name = $_SESSION['user_name'];
        
            echo "<p>Attempt " . $this->attempt . "</p>";
        
            if ($this->answer == $this->guess) {
                $_SESSION['game_result'] = "won";
                header("Location: lucky_result.php");
                die;
            } else {
                if ($this->answer < $this->guess) {
                    echo $this->guess . " is wrong. </br>";
                    echo $name . ". You should go lower.";
                }
                if ($this->answer > $this->guess) {
                    echo $this->guess . " is wrong. </br>";
                    echo $name . ". You should go higher.";
                }
        
                if ($this->attempt == 10) {
                    $_SESSION['game_result'] = "lost";
                    header("Location: lucky_result.php");
                    die;
                }
                $this->attempt += 1;
                $_SESSION['attempts'] = $this->attempt;
            }
        }
    }
}
