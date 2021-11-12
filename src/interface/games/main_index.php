<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("../../classes/Connection.php");
include_once("../../classes/GamePlatform.php");

// include("../utils/connection.php");
// include("../utils/scores_functions.php");

// if (!isset($_SESSION['session_id'])) {
//     header("Location: ../account/signin.php");
//     die;
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Games</title>
    <link href="../../../asset/design.css" rel="stylesheet">
    <link href="../../../asset/button.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>

<body class="wrapper">
    <div class="container container-index">
        <div class="card item">
            <article class="card-body">
                <h2 class="card-title text-center mb-4 mt-1">Brainy</h2>
                <hr>
                <p class="text-secondary text-center">
                    🃏 Match your way to </br>foresee the future 🔮</p>
            </article>
            <div class="form-group card-footer" style="background-color: white; border:0;">
                <div class="row">
                    <div class="col">
                        <form>
                            <div ontouchstart="">
                                <div class="button">
                                    <a href="brainy/brainy_index.php" style="text-decoration: none;">🕹️</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <div ontouchstart="">
                            <div class="button">
                                <a href="#BrainyRecords" data-toggle="modal" data-target="#BrainyRecords" style="text-decoration: none;">🏆</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="BrainyRecords" tabindex="-1" role="dialog" aria-labelledby="BrainyRecords" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="BrainyRecords">Brainy Top Scores</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $con = new Connection();
                        $con->setConnection();
                        $platform = new GamePlatform();
                        $platform->getBrainyScores($con->getConnection());
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card item">
            <article class="card-body">
                <h2 class="card-title text-center mb-4 mt-1">Lucky Number</h2>
                <hr>
                <p class="text-secondary text-center">
                    🍌 Join our curious monkeys in </br>exploring the mystery number 🤞</p>
            </article>
            <div class="form-group card-footer" style="background-color: white; border:0;">
                <div class="row">
                    <div class="col">
                        <form>
                            <div ontouchstart="">
                                <div class="button">
                                    <a href="lucky/lucky_index.php" style="text-decoration: none;">🕹️</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <div ontouchstart="">
                            <div class="button">
                                <a href="#LuckyNumberRecords" data-toggle="modal" data-target="#LuckyNumberRecords" style="text-decoration: none;">🏆</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="LuckyNumberRecords" tabindex="-1" role="dialog" aria-labelledby="LuckyNumberRecords" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="LuckyNumberRecords">Lucky Number Top Scores</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $con = new Connection();
                        $con->setConnection();
                        $platform = new GamePlatform();
                        $platform->getLuckyScores($con->getConnection());
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card item">
            <article class="card-body">
                <h2 class="card-title text-center mb-4 mt-1">Spell Me</h2>
                <hr>
                <p class="text-secondary text-center">
                    📖 Forbidden spells scattered in place! </br>Help our wizard to conceal them 🧙</p>
            </article>
            <div class="form-group card-footer" style="background-color: white; border:0;">
                <div class="row">
                    <div class="col">
                        <form>
                            <div ontouchstart="">
                                <div class="button">
                                    <a href="spell/spell_index.php" style="text-decoration: none;">🕹️</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <div ontouchstart="">
                            <div class="button">
                                <a href="#SpellMeRecords" data-toggle="modal" data-target="#SpellMeRecords" style="text-decoration: none;">🏆</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="SpellMeRecords" tabindex="-1" role="dialog" aria-labelledby="SpellMeRecords" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="SpellMeRecords">Spell Me Top Scores</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $con = new Connection();
                        $con->setConnection();
                        $platform = new GamePlatform();
                        $platform->getSpellMeScores($con->getConnection(), "hard");
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>