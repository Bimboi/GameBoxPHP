<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("../../../classes/Constants.php");

$game_name = Constants::brainy_name;

if (!isset($_SESSION['session_id'])) {
    header("Location: ../../account/signin.php");
    $_SESSION['game_redirect'] = $game_name;
    die;
} else if (isset($_SESSION['selected_game'])) {
    if ($_SESSION['selected_game'] != $game_name) {
        header("Location: brainy_index.php");
        die;
    }
} else {
    header("Location: brainy_index.php");
    die;
}

include_once("../../../classes/Game.php");
include_once("../../../classes/Memory.php");

$game = new Memory();
$game->setSelectedCards();

if (isset($_SESSION['first_pick']) && isset($_SESSION['second_pick'])) {
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
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, "/phpcourseneyney/proj_php/src/interface/games/brainy/brainy_index.php");
        }
    </script>
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
                                $yes = Constants::yes;
                                $revealed = Constants::revealed;
                                $disabled = Constants::disabled;
                                $cover_img = Constants::brainy_cover_img;

                                for ($x = 1; $x <= 9; $x += 3) {
                                    echo "<tr>";
                                    for ($y = $x; $y < $x + 3; $y++) {
                                        $name_memory = "memory_" . $y;
                                        $name_card = "card_" . $y;
                                        $name_send = "send_" . $y;
                                        if ($_SESSION[$name_memory][1] == $revealed) {
                                            $card = $_SESSION[$name_memory][0];
                                            $_SESSION['input_status'] = $disabled;
                                        } else {
                                            $card = $cover_img;
                                            $_SESSION['input_status'] = "";
                                        }

                                        if ($_SESSION['disable_all_input'] == $yes) {
                                            $_SESSION['input_status'] = $disabled;
                                        }

                                        echo
                                        "<td>
                                        <form method='POST' action='brainy_play.php'>
                                            <input type='hidden' name='" . $name_card . "' value='" . $name_memory . "'>
                                            <input type='image' id='" . $name_memory . "' src='" . $card . "' " . $_SESSION['input_status'] . ">
                                        </form>
                                        </td>";
                                    }
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                            <br>
                            <hr>
                            <h5>
                                <?php
                                $attempts = $_SESSION['attempts'];
                                $attempt_display = 0;
                                if ($attempts == 10 or $_SESSION['match_count'] == 4) {
                                    echo "Game ended";
                                } else {
                                    if ($_SESSION['disable_all_input'] == $yes) {
                                        $attempt_display = $attempts;
                                    } else {
                                        $attempt_display = $attempts + 1;
                                    }
                                    echo "Attempt #" . $attempt_display;
                                }
                                ?>
                            </h5>
                        </center>
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

<?php
if (isset($_SESSION['first_pick']) && isset($_SESSION['second_pick'])) {
    $hidden = Constants::hidden;
    $no = Constants::no;
    if ($_SESSION[$_SESSION['first_pick']][0] != $_SESSION[$_SESSION['second_pick']][0]) {
        $name_first_pick = $_SESSION['first_pick'];
        $name_second_pick = $_SESSION['second_pick'];
        $_SESSION[$name_first_pick] = [$_SESSION[$name_first_pick][0], $hidden];
        $_SESSION[$name_second_pick] = [$_SESSION[$name_second_pick][0], $hidden];
    }
    $_SESSION['disable_all_input'] = $no;
    unset($_SESSION['first_pick']);
    unset($_SESSION['second_pick']);
}
?>