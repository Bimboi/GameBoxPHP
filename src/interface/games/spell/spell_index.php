<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("../../../classes/Constants.php");

$game_name = Constants::spell_name;

if (!isset($_SESSION['session_id'])) {
    header("Location: ../../account/signin.php");
    $_SESSION['game_redirect'] = $game_name;
    die;
}

include_once("../../../classes/GamePlatform.php");

$game = new GamePlatform();
$game->pickGame($game_name);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Spell Me</title>
    <link href="../../../../asset/design.css" rel="stylesheet">
    <link href="../../../../asset/button.css" rel="stylesheet">
    <link href="../../../../asset/button_back.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
        function changeMode() {
            if ($('#checkbox-1').is(':checked')) {
                $('#words').html("difficult");
                $('#game-mode').val(<?php echo '"' . Constants::advance . '"'?>);
            } else {
                $('#words').html("basic");
                $('#game-mode').val(<?php echo '"' . Constants::easy . '"'?>);
            }   
        }
    </script>
</head>

<body>
    <div class="wrapper" style="background: url('https://www.toptal.com/designers/subtlepatterns/patterns/geometry2.png');">
        <div class="container">
            <div class="row justify-content-center">
                <aside class="col-sm-6">
                    <div class="card shadow" style="position:relative; text-align:center">
                        <article class="card-body">
                            <h1 class="card-title text-center mb-4 mt-1">📖 Spell Me 🧙</h1>
                            <hr style="margin-bottom: 30px;">
                            <h4 class="text-dark text-center">🥱 2 minutes</h4>
                            <h4 class="text-dark text-center">🔎 10 <span  id="words">basic</span> words</h4>
                            <div class="form-group" style="margin-top: 30px;">
                                <form id="form-1" method="POST" action="spell_play.php" style="margin-bottom: 20px;">
                                    <div class="row justify-content-center">
                                        <input type="hidden" id="game-mode" name="game_mode" value=<?php echo '"' . Constants::easy . '"'?>/>
                                        <div class="col">
                                            <h5 class="text-right" style="user-select:none">Easy</h5>
                                        </div>
                                        <div class="col-auto">
                                            <label class="switch">
                                                <input type="checkbox" onclick="changeMode()" id="checkbox-1">
                                                <div>
                                                    <span></span>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <h5 class="text-left" style="user-select:none">Advance</h5>
                                        </div>
                                    </div>

                                </form>
                                <div class="row justify-content-center">
                                    <div ontouchstart="">
                                        <div class="button_back">
                                            <a href="../main_index.php" style="color: white; font-weight: bold;">Back</a>
                                        </div>
                                    </div>
                                    <div ontouchstart="">
                                        <div class="button">
                                            <a href="#" onclick="document.getElementById('form-1').submit();" style="color: white; font-weight: bold;">Start</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="navbar fixed-bottom" style="color: black;">
        <?php
        $id = isset($_SESSION['session_id']) ? "ID: " . $_SESSION['session_id'] : '';
        echo $id;
        ?>
    </div>
</body>

</html>