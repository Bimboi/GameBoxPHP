<?php
class Memory extends Game
{
    private $attempts;
    private $match_count;
    private $cardList;

    public function __construct()
    {
        $this->game_name = "memory";
        $this->attempts = isset($_SESSION['attempts']) ? (int) $_SESSION['attempts'] : 0;
        $this->match_count = isset($_SESSION['match_count']) ? (int) $_SESSION['match_count'] : 0;
        $this->cardList = array();
    }

    function initGameVariables()
    {
        $_SESSION['input_status'] = "";
        $_SESSION['disable_all_input'] = "no";
        $_SESSION['game_name'] = $this->game_name;
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
    }

    function unsetPicks()
    {
        unset($_SESSION['first_pick']);
        unset($_SESSION['second_pick']);
    }

    public function shuffleCards()
    {
        $this->cardList = array(
            0 => array("../../../../asset/images/Forest_Witch_Arita.png", "hidden"),
            1 => array("../../../../asset/images/Forest_Witch_Arita.png", "hidden"),
            2 => array("../../../../asset/images/Izuna_the_Vigilante.png", "hidden"),
            3 => array("../../../../asset/images/Izuna_the_Vigilante.png", "hidden"),
            4 => array("../../../../asset/images/Super_Mandy.png", "hidden"),
            5 => array("../../../../asset/images/Super_Mandy.png", "hidden"),
            6 => array("../../../../asset/images/Berserk-V.png", "hidden"),
            7 => array("../../../../asset/images/Berserk-V.png", "hidden"),
            8 => array("../../../../asset/images/Brave_Dog.png", "hidden")
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
        echo "<script>console.log('inside function match')</script>";

        for ($x = 1; $x <= 9; $x++) {
            $name_card = "card_" . $x;
            if (isset($_POST[$name_card])) {
                echo "<script>console.log('" . $name_card . " post')</script>";
                $name_memory_post = $_POST[$name_card];
                unset($_POST[$name_card]);
                echo "<script>console.log('attempt " . $_SESSION['attempts'] . "')</script>";

                if ($_SESSION[$name_memory_post][1] != "revealed"){
                    if (!isset($_SESSION['first_pick'])) {
                        $_SESSION[$name_memory_post] = [$_SESSION[$name_memory_post][0], "revealed"];
                        $_SESSION['first_pick'] = $name_memory_post;
                        echo "<script>console.log('name: " . $name_memory_post . "')</script>";
                        echo "<script>console.log('src: " . $_SESSION[$name_memory_post][0] . "')</script>";
                        echo "<script>console.log('status: " . $_SESSION[$name_memory_post][1] . "')</script>";
                        // for ($x = 1; $x <= 9; $x++) {
                        //     $name_memory_ref = "memory_" . $x;
                        //     if ($_SESSION[$name_memory_ref][0] == $_SESSION[$name_memory_post][0]) {
                        //         if ($_SESSION[$name_memory_ref][1] != "revealed") {
                        //             $_SESSION['first_pick'] = $name_memory_post;
                        //             echo "<script>console.log('" . $name_memory_ref . " first pick break')</script>";
                        //             $_SESSION[$name_memory_ref] = [$_SESSION[$name_memory_ref][0], "revealed"];
                        //             break;
                        //         } else {
                        //             echo "<script>console.log('" . $name_memory_ref . " first pick return')</script>";
                        //             return;
                        //         }
                        //     }
                        // }
                    } else if (!isset($_SESSION['second_pick'])) {
                            $_SESSION[$name_memory_post] = [$_SESSION[$name_memory_post][0], "revealed"];
                            $_SESSION['second_pick'] =  $name_memory_post;
                            echo "<script>console.log('name: " . $name_memory_post . "')</script>";
                            echo "<script>console.log('src: " . $_SESSION[$name_memory_post][0] . "')</script>";
                            echo "<script>console.log('status: " . $_SESSION[$name_memory_post][1] . "')</script>";

                } else {
                    return;
                }
            

                    // for ($x = 1; $x <= 9; $x++) {
                    //     $name_memory_ref = "memory_" . $x;
                    //     if ($_SESSION[$name_memory_ref][0] == $_SESSION[$name_memory_post][0]) {
                    //         if ($_SESSION[$name_memory_ref][1] != "revealed") {
                    //             echo "<script>console.log('" . $name_memory_ref . " second pick')</script>";
                    //             $_SESSION['second_pick'] =  $name_memory_post;
                    //             $_SESSION[$name] = [$_SESSION[$name][0], "revealed"];
                    //             break;
                    //         } else {
                    //             return;
                    //         }
                    //     }
                    // }
                }

                // if (isset($_SESSION['first_pick']) && isset($_SESSION['second_pick'])) {
                //     // $this->incrementAttempt();
                //     $_SESSION['attempts'] = $_SESSION['attempts'] + 1;
                //     echo "<script>console.log('inside match')</script>";
                //     echo "<script>console.log('attempt " . $_SESSION['attempts'] . "')</script>";
                //     if ($_SESSION[$_SESSION['first_pick']][0] == $_SESSION[$_SESSION['second_pick']][0]) {
                //         // switch ($_SESSION['match_count']) {
                //         //     case 0:
                //         //         $_SESSION['match_1'] = $_SESSION['first_pick'];
                //         //         break;
                //         //     case 1:
                //         //         $_SESSION['match_2'] = $_SESSION['first_pick'];
                //         //         break;
                //         //     case 2:
                //         //         $_SESSION['match_3'] = $_SESSION['first_pick'];
                //         //         break;
                //         //     case 3:
                //         //         $_SESSION['match_4'] = $_SESSION['first_pick'];
                //         //         break;
                //         // }
                //         $_SESSION['match_count'] = $_SESSION['match_count'] + 1;
                //         echo "<script>console.log('match count " . $_SESSION['match_count'] . "')</script>";

                //         // if ($_SESSION['match_count'] == 4) {
                //         //     $this->unsetPicks();
                //         //     header("Location: brainy_index.php");
                //         //     die;
                //         // }
                //     } else {
                //         $name_first_pick = $_SESSION['first_pick'];
                //         $name_second_pick = $_SESSION['second_pick'];
                //         $_SESSION[$name_first_pick] = [$_SESSION[$name_first_pick][0], "hidden"];
                //         $_SESSION[$name_second_pick] = [$_SESSION[$name_second_pick][0], "hidden"];
                //         echo "<script>console.log('inside unset " . $name_first_pick . "')</script>";
                //         echo "<script>console.log('inside unset " . $name_second_pick . "')</script>";
                //         // for ($x = 1; $x <= 9; $x++) {
                //         //     $name_memory = "memory_" . $x;
                //         //     if ($_SESSION[$name_memory][0] == $_SESSION[$name_pick]) {
                //         //         echo "<script>console.log('inside unset " . $name_pick . "')</script>";
                //         //         echo "<script>console.log('inside unset " . $name_memory . "')</script>";

                //         //         $_SESSION[$name_memory] = [$_SESSION[$name_memory][0], "hidden"];
                //         //         if ($name_pick == "second_pick") {
                //         //             break;
                //         //         }
                //         //         $name_pick = 'second_pick';
                //         //     }
                //         // }
                //     }
                //     $this->unsetPicks();

                // }
                break;
            }
        }
    }
    public function matchSelectedCards()
    {
        $this->incrementAttempt();
        echo "<script>console.log('inside match')</script>";
        echo "<script>console.log('attempt " . $_SESSION['attempts'] . "')</script>";
        if ($_SESSION[$_SESSION['first_pick']][0] == $_SESSION[$_SESSION['second_pick']][0]) {
            $_SESSION['match_count'] = $_SESSION['match_count'] + 1;
            echo "<script>console.log('match count " . $_SESSION['match_count'] . "')</script>";

            if ($_SESSION['match_count'] == 4) {
                // $this->unsetPicks();
            // $_SESSION['input_status'] = "disabled";

                    for ($x = 1; $x <= 9; $x++) {
                        $name_memory_ref = "memory_" . $x;
                        if ($_SESSION[$name_memory_ref][1] == "hidden") {
                            $_SESSION[$name_memory_ref] = [$_SESSION[$name_memory_ref][0], "revealed"];

                        }
                    }
                    $_SESSION['game_result'] = "won";
                    header( "refresh:2; url=brainy_result.php"); 

                // header("Location: brainy_index.php");
                // die;
            } else {
                if ($_SESSION['attempts'] == 10) {
                    $_SESSION['game_result'] = "lost";
                    header( "refresh:2; url=brainy_result.php"); 
                }
            }
        } else {
            // $_SESSION['input_status'] = "disabled";
        $_SESSION['disable_all_input'] = "yes";

    header( "refresh:3; url=" . $_SERVER['PHP_SELF']); 

            // $name_first_pick = $_SESSION['first_pick'];
            // $name_second_pick = $_SESSION['second_pick'];
            // $_SESSION[$name_first_pick] = [$_SESSION[$name_first_pick][0], "hidden"];
            // $_SESSION[$name_second_pick] = [$_SESSION[$name_second_pick][0], "hidden"];
            // echo "<script>console.log('inside unset " . $name_first_pick . "')</script>";
            // echo "<script>console.log('inside unset " . $name_second_pick . "')</script>";
        }
        // $this->unsetPicks();
        // header("Location: brainy_play.php");
        // die;
    }
}
