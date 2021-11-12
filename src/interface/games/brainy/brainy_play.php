<?php
if (!isset($_SESSION)) {
    session_start();
}

// if (!isset($_SESSION['session_id']) || !isset($_SESSION['game_session_id'])) {
//     header("Location: ../../account/signin.php");
//     $_SESSION['game_redirect'] = "brainy_game";
//     die;
// }

include_once("../../../classes/Game.php");
include_once("../../../classes/Memory.php");

$game = new Memory();

// if (!isset($_SESSION['memory_1'])) {
//     $game->initGameVariables();
// }

// if (!isset($_SESSION['first_pick']) || !isset($_SESSION['second_pick'])) {
$game->setSelectedCards();
// }
if (isset($_SESSION['checking_status'])) {
    unset($_SESSION['checking_status']);

    $game->matchSelectedCards();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Brainy!</title>
    <link href="../../../../asset/design.css" rel="stylesheet">
    <link href="../../../../asset/button.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php

    // for ($x = 1; $x <= 9; $x++) {
    //     $name_func = "send_" . $x;
    //     $name_memory = "memory_" . $x;
    //     $name_card = "card_" . $x . "=";
    //     $name_send = "send_" . $x;
    //     echo "<script>
    //             function " . $name_func ."(){
    //                 $.ajax({
    //                     type:'post',
    //                     url:'brainy_process.php',
    //                     data:'" . $name_card . "" . $name_memory . "',
    //                     cache:false,
    //                     success:function(){
    //                         $('#" . $name_memory . "').html(\"<input type='image' id='" . $name_memory . "' src='" . $_SESSION[$name_memory][0] . "' onclick='return " . $name_send . "()'>\");
    //                     }
    //                 })
    //                 return false;
    //             }
    //         </script>";
    // }
    ?>
</head>

<body class="wrapper" style="background: url('https://www.toptal.com/designers/subtlepatterns/patterns/darkness.png');">
    <div class="container">
        <div class="row justify-content-center">
            <aside class="col-sm-6">
                <div class="card shadow" style="position:relative; text-align:center">
                    <article class="card-body">
                        <h1 class="card-title text-center mb-4 mt-1">🤓 Brainy! 🃏</h1>
                        <hr>
                        <p>We have shuffled matching cards and a joker.
                            </br>See if you can find all matches.</p>

                        <center>
                            <table border='0' style='border-collapse:collapse; text-align:center; height:350px; width:350px;'>
                                <?php

                                for ($x = 1; $x <= 9; $x += 3) {
                                    echo "<tr>";
                                    for ($y = $x; $y < $x + 3; $y++) {
                                        $name_memory = "memory_" . $y;
                                        $name_card = "card_" . $y;
                                        $name_send = "send_" . $y;
                                        $card = $_SESSION[$name_memory][1] == "revealed" ? $_SESSION[$name_memory][0] : "../../../../asset/images/Blue_Cover.png";
                                        echo
                                        "<td>
                                    <form method='POST' action='brainy_play.php'>
                                        <input type='hidden' name='" . $name_card . "' value='" . $name_memory . "'>
                                        <input type='image' id='" . $name_memory . "' src='" . $card . "'>
                                    </form>
                                </td>";
                                        // echo 
                                        // "<td>
                                        //     <form method='POST' action='brainy_play.php'>
                                        //         <input type='hidden' name='" . $name_card . "' value='" . $_SESSION[$name_memory][0] . "'>
                                        //         <input type='image' src='" . $card . "'>
                                        //     </form>
                                        // </td>";
                                    }
                                    echo "</tr>";
                                }
                                
                                ?>
                            </table>
                            <?php
                            if (isset($_SESSION['first_pick']) && isset($_SESSION['second_pick'])) {
                                $_SESSION['checking_status'] = 1;
                            }

                            ?>
                        </center>

                        <!-- <form method="POST" action="" style="margin-bottom: 10px;"> -->
                        <?php

                        // $card1 = $_SESSION['memory_1'][1] == "revealed" ? $_SESSION['memory_1'][0] : "../../../../asset/images/Blue_Cover.png";
                        // $card2 = $_SESSION['memory_2'][1] == "revealed" ? $_SESSION['memory_2'][0] : "../../../../asset/images/Blue_Cover.png";
                        // $card3 = $_SESSION['memory_3'][1] == "revealed" ? $_SESSION['memory_3'][0] : "../../../../asset/images/Blue_Cover.png";
                        // $card4 = $_SESSION['memory_4'][1] == "revealed" ? $_SESSION['memory_4'][0] : "../../../../asset/images/Blue_Cover.png";
                        // $card5 = $_SESSION['memory_5'][1] == "revealed" ? $_SESSION['memory_5'][0] : "../../../../asset/images/Blue_Cover.png";
                        // $card6 = $_SESSION['memory_6'][1] == "revealed" ? $_SESSION['memory_6'][0] : "../../../../asset/images/Blue_Cover.png";
                        // $card7 = $_SESSION['memory_7'][1] == "revealed" ? $_SESSION['memory_7'][0] : "../../../../asset/images/Blue_Cover.png";
                        // $card8 = $_SESSION['memory_8'][1] == "revealed" ? $_SESSION['memory_8'][0] : "../../../../asset/images/Blue_Cover.png";
                        // $card9 = $_SESSION['memory_9'][1] == "revealed" ? $_SESSION['memory_9'][0] : "../../../../asset/images/Blue_Cover.png";

                        // echo "<center><table border=0 style='text-align:center; height: 350px; width: 350px'>";
                        // echo "<tr>";
                        // echo "<td>
                        //         <form method='POST' action='brainy_play.php'>
                        //             <input type='hidden' name='card' value='" . $_SESSION['memory_1'][0] . "'>
                        //             <input type='image' src='" . $card1 . "'>
                        //         </form>
                        //         </td>";
                        // echo "<td>
                        //         <form method='POST' action='brainy_play.php'>
                        //             <input type='hidden' name='card' value='" . $_SESSION['memory_2'][0] . "'>
                        //             <input type='image' src='" . $card2 . "'>
                        //         </form>
                        //         </td>";
                        // echo "<td>
                        //         <form method='POST' action='brainy_play.php'>
                        //             <input type='hidden' name='card' value='" . $_SESSION['memory_3'][0] . "'>
                        //             <input type='image' src='" . $card3 . "'>
                        //         </form>
                        //         </td>";
                        // echo "</tr>";
                        // echo "<tr>";
                        // echo "<td>
                        //         <form method='POST' action='brainy_play.php'>
                        //             <input type='hidden' name='card' value='" . $_SESSION['memory_4'][0] . "'>
                        //             <input type='image' src='" . $card4 . "'>
                        //         </form>
                        //         </td>";
                        // echo "<td>
                        //         <form method='POST' action='brainy_play.php'>
                        //             <input type='hidden' name='card' value='" . $_SESSION['memory_5'][0] . "'>
                        //             <input type='image' src='" . $card5 . "'>
                        //         </form>
                        //         </td>";
                        // echo "<td>
                        //         <form method='POST' action='brainy_play.php'>
                        //             <input type='hidden' name='card' value='" . $_SESSION['memory_6'][0] . "'>
                        //             <input type='image' src='" . $card6 . "'>
                        //         </form>
                        //         </td>";
                        // echo "</tr>";
                        // echo "<tr>";
                        // echo "<td>
                        //         <form method='POST' action='brainy_play.php'>
                        //             <input type='hidden' name='card' value='" . $_SESSION['memory_7'][0] . "'>
                        //             <input type='image' src='" . $card7 . "'>
                        //         </form>
                        //         </td>";
                        // echo "<td>
                        //         <form method='POST' action='brainy_play.php'>
                        //             <input type='hidden' name='card' value='" . $_SESSION['memory_8'][0] . "'>
                        //             <input type='image' src='" . $card8 . "'>
                        //         </form>
                        //         </td>";
                        // echo "<td>
                        //         <form method='POST' action='brainy_play.php'>
                        //             <input type='hidden' name='card' value='" . $_SESSION['memory_9'][0] . "'>
                        //             <input type='image' src='" . $card9 . "'>
                        //         </form>
                        //         </td>";
                        // echo "</tr>";
                        // echo "</table></center>";

                        // echo "<center><table border=0 style='border-collapse:collapse; text-align:center; height:350px; width:350px;>";
                        // echo "<tr>";
                        // echo "<td><input type='image' name='card1' value='" . $_SESSION['memory_1'][0] . "' src='" . $card1 . "' onclick='return send1()'></td>";
                        // echo "<td><input type='image' name='card2' value='" . $_SESSION['memory_2'][0] . "' src='" . $card2 . "' onclick='return send2()'></td>";
                        // echo "<td><input type='image' name='card3' value='" . $_SESSION['memory_3'][0] . "' src='" . $card3 . "' onclick='return send3()'></td>";
                        // echo "<td><input type='image' name='card3' value='" . $_SESSION['memory_3'][0] . "' src='" . $card3 . "' onclick='return send3()'></td>";
                        // echo "</tr>";
                        // echo "<tr>";
                        // echo "<td><input type='image' name='card4' value='" . $_SESSION['memory_4'][0] . "' src='" . $card4 . "' onclick='return send4()'></td>";
                        // echo "<td><input type='image' name='card5' value='" . $_SESSION['memory_5'][0] . "' src='" . $card5 . "' onclick='return send5()'></td>";
                        // echo "<td><input type='image' name='card6' value='" . $_SESSION['memory_6'][0] . "' src='" . $card6 . "' onclick='return send6()'></td>";
                        // echo "</tr>";
                        // echo "<tr>";
                        // echo "<td><input type='image' name='card7' value='" . $_SESSION['memory_7'][0] . "' src='" . $card7 . "' onclick='return send7()'></td>";
                        // echo "<td><input type='image' name='card8' value='" . $_SESSION['memory_8'][0] . "' src='" . $card8 . "' onclick='return send8()'></td>";
                        // echo "<td><input type='image' name='card9' value='" . $_SESSION['memory_9'][0] . "' src='" . $card9 . "' onclick='return send9()'></td>";
                        // echo "</tr>";
                        // echo "</table></center>";

                        // for ($x = 1; $x <= 9; $x++) {
                        //     $name_memory = "memory_" . $x;
                        //     $name_card = "card" . $x;
                        //     echo "<input type='hidden' name='" . $name_card . "' value='" . $_SESSION[$name_memory][0] . "'>";
                        // }
                        // 
                        ?>
                        <!-- </form> -->
                    </article>
                </div>
            </aside>
        </div>
    </div>
    <div class="navbar fixed-bottom" style="color: white;">
        <?php
        $id = isset($_SESSION['session_id']) ? "ID: " . $_SESSION['session_id'] : '';
        echo $id;
        ?>
    </div>
</body>

</html>