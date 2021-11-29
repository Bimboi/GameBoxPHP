<?php
class Memory extends Game
{
    private $attempts;
    private $cardList;

    private $img_filler = Constants::brainy_filler_img;
    private $img_1 = Constants::brainy_guess_img_1;
    private $img_2 = Constants::brainy_guess_img_2;
    private $img_3 = Constants::brainy_guess_img_3;
    private $img_4 = Constants::brainy_guess_img_4;
    private $revealed = Constants::revealed;
    private $hidden = Constants::hidden;
    private $won = Constants::won;
    private $lost = Constants::lost;
    private $yes = Constants::yes;
    private $no = Constants::no;

    public function __construct()
    {
        $this->attempts = isset($_SESSION['attempts']) ? (int) $_SESSION['attempts'] : 0;
        $this->match_count = isset($_SESSION['match_count']) ? (int) $_SESSION['match_count'] : 0;
        $this->cardList = array();
    }

    function initGameVariables()
    {
        $_SESSION['input_status'] = "";
        $_SESSION['disable_all_input'] = $this->no;
        $_SESSION['game_name'] = Constants::brainy_name;
        $_SESSION['attempts'] = 0;
        $_SESSION['match_count'] = 0;

        $this->shuffleCards();
        $_SESSION['memory_1'] = $this->cardList[0];
        $_SESSION['memory_2'] = $this->cardList[1];
        $_SESSION['memory_3'] = $this->cardList[2];
        $_SESSION['memory_4'] = $this->cardList[3];
        $_SESSION['memory_5'] = $this->cardList[4];
        $_SESSION['memory_6'] = $this->cardList[5];
        $_SESSION['memory_7'] = $this->cardList[6];
        $_SESSION['memory_8'] = $this->cardList[7];
        $_SESSION['memory_9'] = $this->cardList[8];
    }

    function unsetGameVariables()
    {
        unset($_SESSION['attempts']);
        unset($_SESSION['match_count']);
        unset($_SESSION['memory_1']);
        unset($_SESSION['memory_2']);
        unset($_SESSION['memory_3']);
        unset($_SESSION['memory_4']);
        unset($_SESSION['memory_5']);
        unset($_SESSION['memory_6']);
        unset($_SESSION['memory_7']);
        unset($_SESSION['memory_8']);
        unset($_SESSION['memory_9']);
        $this->unsetPicks();
    }

    function unsetPicks()
    {
        unset($_SESSION['first_pick']);
        unset($_SESSION['second_pick']);
    }

    public function shuffleCards()
    {
        $this->cardList = array(
            0 => array($this->img_1, $this->hidden),
            1 => array($this->img_1, $this->hidden),
            2 => array($this->img_2, $this->hidden),
            3 => array($this->img_2, $this->hidden),
            4 => array($this->img_3, $this->hidden),
            5 => array($this->img_3, $this->hidden),
            6 => array($this->img_4, $this->hidden),
            7 => array($this->img_4, $this->hidden),
            8 => array($this->img_filler, $this->hidden)
        );
        shuffle($this->cardList);
    }

    public function getCardList()
    {
        return $this->cardList;
    }

    public function incrementAttempt()
    {
        $_SESSION['attempts'] =  $this->attempts + 1;
    }

    public function setSelectedCards()
    {
        for ($x = 1; $x <= 9; $x++) {
            $name_card = "card_" . $x;
            if (isset($_POST[$name_card])) {
                $name_memory_post = $_POST[$name_card];
                unset($_POST[$name_card]);
                if ($_SESSION[$name_memory_post][1] != $this->revealed) {
                    if (!isset($_SESSION['first_pick'])) {
                        $_SESSION[$name_memory_post] = [$_SESSION[$name_memory_post][0], $this->revealed];
                        $_SESSION['first_pick'] = $name_memory_post;
                    } else if (!isset($_SESSION['second_pick'])) {
                        $_SESSION[$name_memory_post] = [$_SESSION[$name_memory_post][0], $this->revealed];
                        $_SESSION['second_pick'] =  $name_memory_post;
                    } else {
                        return;
                    }
                }
                break;
            }
        }
    }
    public function matchSelectedCards()
    {
        $this->incrementAttempt();
        if ($_SESSION[$_SESSION['first_pick']][0] == $_SESSION[$_SESSION['second_pick']][0]) {
            $_SESSION['match_count'] = $_SESSION['match_count'] + 1;
            if ($_SESSION['match_count'] == 4) {
                $this->revealFiller();
                $_SESSION['game_result'] = $this->won;
                header("refresh:2; url=brainy_result.php");
            }
        } else {
            if ($_SESSION['attempts'] == 10) {
                $this->revealFiller();
                $_SESSION['game_result'] = $this->lost;
                header("Location: brainy_result.php");
            } else {
                $_SESSION['disable_all_input'] = $this->yes;
                header("refresh:2; url=" . $_SERVER['PHP_SELF']);
            }
        }
    }

    public function revealFiller() {
        for ($x = 1; $x <= 9; $x++) {
            $name_memory_ref = "memory_" . $x;
            if ($_SESSION[$name_memory_ref][1] == $this->hidden) {
                $_SESSION[$name_memory_ref] = [$_SESSION[$name_memory_ref][0], $this->revealed];
            }
        }
    }
}
