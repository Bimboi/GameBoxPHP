<?php

class Spelling extends Game {
    private $difficulty;
    private $wordSet;

    private $easy = Constants::easy;
    private $advance = Constants::advance;

    function __construct()
    {
        $this->game_name = Constants::spell_name;
        $this->difficulty = isset($_SESSION['difficulty']) ? $_SESSION['difficulty'] : $this->easy;
    }

    function initGameVariables()
    {
        $_SESSION['game_name'] = $this->game_name;
        $_SESSION['time_spent'] = 0;
    }

    function setDifficulty($mode) {
        $_SESSION['difficulty'] = $mode;
        $this->difficulty = $mode;

        $this->setWordSet();
    }

    function unsetGameVariables()
    {
        unset($_SESSION['game_name']);
        unset($_SESSION['time_spent']);
        unset($_SESSION['difficulty']);

        unset($_SESSION['words_1']);
        unset($_SESSION['words_2']);
        unset($_SESSION['words_3']);
        unset($_SESSION['words_4']);
        unset($_SESSION['words_5']);
    }

    public function setWordSet() {
        $numbers = range(0, 4);
        shuffle($numbers);

        if ($this->difficulty == $this->easy) {
            $this->wordSet = array(
                $numbers[0] => array(Constants::word_easy_1_correct, Constants::word_easy_1_wrong),
                $numbers[1] => array(Constants::word_easy_2_correct, Constants::word_easy_2_wrong),
                $numbers[2] => array(Constants::word_easy_3_correct, Constants::word_easy_3_wrong),
                $numbers[3] => array(Constants::word_easy_4_correct, Constants::word_easy_4_wrong),
                $numbers[4] => array(Constants::word_easy_5_correct, Constants::word_easy_5_wrong)
            );
        } else if ($this->difficulty == $this->advance) {
            $this->wordSet = array(
                $numbers[0] => array(Constants::word_advance_1_correct, Constants::word_advance_1_wrong),
                $numbers[1] => array(Constants::word_advance_2_correct, Constants::word_advance_2_wrong),
                $numbers[2] => array(Constants::word_advance_3_correct, Constants::word_advance_3_wrong),
                $numbers[3] => array(Constants::word_advance_4_correct, Constants::word_advance_4_wrong),
                $numbers[4] => array(Constants::word_advance_5_correct, Constants::word_advance_5_wrong)
            );
        }

        foreach ($this->wordSet as &$arr) {
            shuffle($arr);
        }

        unset($arr);

        $_SESSION['words_1'] = $this->wordSet[0];
        $_SESSION['words_2'] = $this->wordSet[1];
        $_SESSION['words_3'] = $this->wordSet[2];
        $_SESSION['words_4'] = $this->wordSet[3];
        $_SESSION['words_5'] = $this->wordSet[4];

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

    public function matchSelectedWords($pickedWords, $time_left)
    {
        $score = 0;
        $answers = array();

        if ($this->difficulty == $this->easy) {
            $answers = array(
                Constants::word_easy_1_correct, 
                Constants::word_easy_2_correct, 
                Constants::word_easy_3_correct, 
                Constants::word_easy_4_correct, 
                Constants::word_easy_5_correct);
        } else if ($this->difficulty == $this->advance) {
            $answers = array(
                Constants::word_advance_1_correct, 
                Constants::word_advance_2_correct, 
                Constants::word_advance_3_correct, 
                Constants::word_advance_4_correct, 
                Constants::word_advance_5_correct);
        }

        for ($x = 0; $x <= 4; $x++) {
            if (in_array($pickedWords[$x], $answers)) {
                $score++;
            }
        }

        if ($score == 5) {
            $_SESSION['game_result'] = Constants::won;
        } else {
            $_SESSION['game_result'] = Constants::lost;
        }

        $_SESSION['spell_score'] = $score;
        $_SESSION['time_spent'] = 120 - $time_left;

        header("Location: spell_result.php");
        die;
    }
}
