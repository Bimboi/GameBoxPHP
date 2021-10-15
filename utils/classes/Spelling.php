<?php

class Spelling extends Game {
    private $difficulty;
    private $wordSet;

    function __construct($difficulty)
    {
        $this->game_name = "spell";
        $this->difficulty = $difficulty;
    }

    function initGameVariables()
    {
        $_SESSION['game_name'] = $this->game_name;
        $_SESSION['time_spent'] = 0;
        $_SESSION['difficulty'] = $this->difficulty;

        $this->setWordSet();
    }

    function unsetGameVariables()
    {
        unset($_SESSION['game_name']);
        unset($_SESSION['time_spent']);
    }

    public function setWordSet() {
        $numbers = range(0, 4);
        shuffle($numbers);

        if ($this->difficulty == "easy") {
            $this->wordSet = array(
                $numbers[0] => array('apple', 'appel'),
                $numbers[1] => array('orange', 'oragne'),
                $numbers[2] => array('banana', 'bananna'),
                $numbers[3] => array('pineapple', 'panapple'),
                $numbers[4] => array('grapes', 'grayps')
            );
        } else if ($this->difficulty == "hard") {
            $this->wordSet = array(
                $numbers[0] => array('quotient', 'qoutient'),
                $numbers[1] => array('conscience', 'conscence'),
                $numbers[2] => array('maintenance', 'maintainance'),
                $numbers[3] => array('deductible', 'deductable'),
                $numbers[4] => array('accommodate', 'accomodate')
            );
        }

        $_SESSION['word_1'] = $this->wordSet[0][0];
        $_SESSION['word_2'] = $this->wordSet[1][0];
        $_SESSION['word_3'] = $this->wordSet[2][0];
        $_SESSION['word_4'] = $this->wordSet[3][0];
        $_SESSION['word_5'] = $this->wordSet[4][0];
    }

    public function getWordSet() {
        return $this->wordSet;
    }

    public function startTimer() {
        while (true) {
            if ($_SESSION['time_spent'] != "60") {
                sleep(1);
                $_SESSION['time_spent'] = (int) $_SESSION['time_spent'] + 1;
            }
        }
    }

    public function matchSelectedWords($pickedWords)
    {
        if ($_SESSION['word_1'] == $pickedWords[0] && $_SESSION['word_2'] == $pickedWords[1] && 
            $_SESSION['word_3'] == $pickedWords[2] && $_SESSION['word_4'] == $pickedWords[3] &&
            $_SESSION['word_5'] == $pickedWords[4]) {
                return "won";
        } else {
            return "lost";
        }
    }
}
?>