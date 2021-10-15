<?php
class Memory extends Game
{
    private $attempts;
    private $match_count;
    private $cardList;
    private $first_selected;
    private $second_selected;

    function __construct()
    {
        $this->game_name = "memory";
        $this->attempts = $_SESSION['attempts'];
        $this->match_count = $_SESSION['match_count'];
        $this->cardList = array();
    }

    function initGameVariables()
    {
        $_SESSION['attempts'] = 0;
        $_SESSION['match_count'] = 0;

        $this->shuffleCards();
    }

    function unsetGameVariables()
    {
        unset($_SESSION['attempts']);
        unset($_SESSION['match_count']);
    }

    function IsGameFinished()
    {
        if ($this->attempts == "10") {
            return "lose";
        } else if ($this->match_count == "4") {
            return "win";
        } else {
            return "not yet";
        }
    }

    public function shuffleCards()
    {
        $numbers = range(1, 9);
        shuffle($numbers);
        $this->cardList = array(
            $numbers[0] => "sampleimg1.png",
            $numbers[1] => "sampleimg2.png",
            $numbers[2] => "sampleimg3.png",
            $numbers[3] => "sampleimg4.png",
            $numbers[4] => "sampleimg5.png",
            $numbers[5] => "sampleimg1.png",
            $numbers[6] => "sampleimg2.png",
            $numbers[7] => "sampleimg3.png",
            $numbers[8] => "sampleimg4.png"
        );
    }

    public function getCardList() {
        return $this->cardList;
    }

    public function incrementAttempt() {
        $_SESSION['attempts'] =  $this->attempts + 1;
    }

    public function setFirstSelected($new_FirstSelected)
    {
        $this->first_selected = $new_FirstSelected;
    }

    public function setSecondSelected($new_SecondSelected)
    {
        $this->second_selected = $new_SecondSelected;
    }

    public function matchSelectedCards()
    {
        if ($this->first_selected == $this->second_selected) {
            if ($_SESSION['match_count'] == "0") {
                $_SESSION['1_match'] = $this->first_selected;
            } else if ($_SESSION['match_count'] == "1") {
                $_SESSION['2_match'] = $this->first_selected;
            } else if ($_SESSION['match_count'] == "2") {
                $_SESSION['3_match'] = $this->first_selected;
            } else if ($_SESSION['match_count'] == "3") {
                $_SESSION['4_match'] = $this->first_selected;
            }
            $_SESSION['match_count'] = $_SESSION['match_count'] + 1;
            return "ok";
        } else {
            return "not ok";
        }
    }
}
