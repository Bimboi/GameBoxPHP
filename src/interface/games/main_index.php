<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("../../classes/Connection.php");
include_once("../../classes/GamePlatform.php");
include_once("../../classes/Constants.php");

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
    <title>GameBox</title>
    <link href="../../../asset/design.css" rel="stylesheet">
    <link href="../../../asset/button.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>

<body class="wrapper">
    <div class="container-fluid container-outer">
        <header class="pr-pl-40px">
            <?php
            if (isset($_SESSION['session_id']) && $_SESSION['session_id'] != "") {
                echo
                '<div class="card-fit-right" style="margin-bottom:10px">
                    <div class="card">
                        <article class="card-body">
                            <h5 class="card-title mb-0 mt-0">Logged in as <u>' . $_SESSION['user_name'] . '</u>
                            </h5>
                        </article>
                    </div>
                </div>';
            }
            ?>

            <div>
                <div class="card">
                    <article class="card-body">
                        <div class="row ml-2 mr-2">
                            <div class="col">
                                <h1 class="card-title text-start mb-0 mt-0" style="font-weight: bold;">
                                    <a href="main_index.php" style="text-decoration: none;">
                                        <span style="color: grey;">Game</span><span style="color: black;">Box</span>
                                        <sup>
                                            <sup class="about-game sm-normal" style="color: black;margin-left: -10px">2021
                                            </sup>
                                        </sup>
                                    </a>
                                </h1>
                            </div>
                            <div class="col">
                                <h2 class="card-title text-right mb-0 mt-0"><a href="../about/about.php" class="nav-header mr-4" style="color:purple;">About</a>
                                    <?php
                                    if (!isset($_SESSION['session_id'])) {
                                        echo '<a class="nav-header" href="../account/signin.php" style="color:black;">Login</a>';
                                    } else {
                                        echo '<a class="nav-header" href="../account/signout.php" style="color:black;">Logout</a>';
                                    }
                                    ?>
                                </h2>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </header>
        <section class="container-fluid container-inside" style="padding-left: 80px; padding-right: 80px;">
            <div class="card item">
                <article class="card-body mb-0">
                    <h2 class="card-title text-center mb-4 mt-1">Brainy!
                        <sup>
                            <sup class="about-game" style="cursor:pointer; font-size:large;">
                                <a href="#AboutBrainy" data-toggle="modal" data-target="#AboutBrainy" style="text-decoration: none; color:black;"> 🛈
                                </a>
                            </sup>
                        </sup>
                    </h2>
                    <hr>
                    <p class="text-secondary text-center text-desc">
                        🃏 Match your way to </br>foresee the future 🔮</p>
                </article>
                <div class="form-group card-footer" style="background-color: white; border:0;">
                    <table class="table-game-menus">
                        <tr>
                            <td colspan=100%>
                                <div ontouchstart="">
                                    <div class="button game-menu" style="margin: 0;">
                                        <a href="brainy/brainy_index.php">🕹️</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;">
                                <div ontouchstart="">
                                    <div class="button game-menu" style="margin: 0;">
                                        <a href="#BrainyRecords" data-toggle="modal" data-target="#BrainyRecords" style="text-decoration: none;">🏆</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card item">
                <article class="card-body">
                    <h2 class="card-title text-center mb-4 mt-1">Lucky Number
                        <sup>
                            <sup class="about-game" style=" cursor:pointer; font-size:large;">
                                <a href="#AboutLuckNumber" data-toggle="modal" data-target="#AboutLuckyNumber" style="text-decoration: none; color:black;"> 🛈
                                </a>
                            </sup>
                        </sup>
                    </h2>
                    <hr>
                    <p class="text-secondary text-center text-desc">
                        🍌 Join our curious monkeys in </br>exploring the mystery number 🤞</p>
                </article>
                <div class="form-group card-footer" style="background-color: white; border:0;">
                    <table class="table-game-menus">
                        <tr>
                            <td colspan=100%>
                                <div ontouchstart="">
                                    <div class="button game-menu" style="margin: 0;">
                                        <a href="lucky/lucky_index.php">🕹️</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;">
                                <div ontouchstart="">
                                    <div class="button game-menu" style="margin: 0;">
                                        <a href="#LuckyNumberRecords" data-toggle="modal" data-target="#LuckyNumberRecords" style="text-decoration: none;">🏆</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card item">
                <article class="card-body">
                    <h2 class="card-title text-center mb-4 mt-0">Spell Me
                        <sup>
                            <sup class="about-game" style=" cursor:pointer; font-size:large;">
                                <a href="#AboutSpellMe" data-toggle="modal" data-target="#AboutSpellMe" style="text-decoration: none; color:black;"> 🛈
                                </a>
                            </sup>
                        </sup>
                    </h2>
                    <hr>
                    <p class="text-secondary text-center text-desc">
                        📖 Forbidden spells scattered in place! </br>Help our wizard to conceal them 🧙</p>
                </article>
                <div class="form-group card-footer" style="background-color: white; border:0;">
                    <table class="table-game-menus">
                        <tr>
                            <td colspan=100%>
                                <div ontouchstart="">
                                    <div class="button game-menu" style="margin: 0;">
                                        <a href="spell/spell_index.php">🕹️</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div ontouchstart="">
                                    <div class="button game-menu" style="margin: 0;">
                                        <a href="#SpellMeRecordsEasy" data-toggle="modal" data-target="#SpellMeRecordsEasy">🎖️</a>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 10px;">
                                <div ontouchstart="">
                                    <div class="button game-menu" style="margin: 0;">
                                        <a href="#SpellMeRecordsAdvance" data-toggle="modal" data-target="#SpellMeRecordsAdvance">🏆</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <!-- <div class="row">
                        <div class="col">
                            <form>
                                <div ontouchstart="">
                                    <div class="button" style="width: 100%;">
                                        <a href="spell/spell_index.php" style="text-decoration: none;">🕹️</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div ontouchstart="">
                                <div class="button">
                                    <a href="#SpellMeRecordsEasy" data-toggle="modal" data-target="#SpellMeRecordsEasy" style="text-decoration: none;">🎖️</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div ontouchstart="">
                                <div class="button">
                                    <a href="#SpellMeRecordsAdvance" data-toggle="modal" data-target="#SpellMeRecordsAdvance" style="text-decoration: none;">🏆</a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
        <footer class="container-footer pr-pl-40px">
            <div style="width: fit-content;">
                <div class="card">
                    <article class="card-body">
                        <h5 class="card-title text-start mb-0 mt-0">Developed by <span style="color:red">CICS</span>
                        </h5>
                    </article>
                </div>
            </div>
        </footer>
    </div>

    <!-- Modal Brainy! Scores-->
    <div class="modal fade text-center" id="BrainyRecords" tabindex="-1" role="dialog" aria-labelledby="BrainyRecords" aria-hidden="true">
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
                    $con_result = $con->checkConnection();

                    if ($con_result instanceof mysqli) {
                        $platform = new GamePlatform();
                        $platform->getBrainyScores($con_result);
                    } else {
                        echo "<center><i>" . $con_result . "</i></center>";
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Lucky Number Scores-->
    <div class="modal fade text-center" id="LuckyNumberRecords" tabindex="-1" role="dialog" aria-labelledby="LuckyNumberRecords" aria-hidden="true">
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
                    $con_result = $con->checkConnection();

                    if ($con_result instanceof mysqli) {
                        $platform = new GamePlatform();
                        $platform->getLuckyScores($con_result);
                    } else {
                        echo "<center><i>" . $con_result . "</i></center>";
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Spell Me Scores Easy -->
    <div class="modal fade text-center" id="SpellMeRecordsEasy" tabindex="-1" role="dialog" aria-labelledby="SpellMeRecordsEasy" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="SpellMeRecordsEasy">Spell Me Top Scores (Easy)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    $con = new Connection();
                    $con_result = $con->checkConnection();

                    if ($con_result instanceof mysqli) {
                        $platform = new GamePlatform();
                        $platform->getSpellMeScores($con_result, Constants::easy);
                    } else {
                        echo "<center><i>" . $con_result . "</i></center>";
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Spell Me Scores Advance -->
    <div class="modal fade text-center" id="SpellMeRecordsAdvance" tabindex="-1" role="dialog" aria-labelledby="SpellMeRecordsAdvance" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="SpellMeRecordsAdvance">Spell Me Top Scores (Advance)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    $con = new Connection();
                    $con_result = $con->checkConnection();

                    if ($con_result instanceof mysqli) {
                        $platform = new GamePlatform();
                        $platform->getSpellMeScores($con_result, Constants::advance);
                    } else {
                        echo "<center><i>" . $con_result . "</i></center>";
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal About Brainy! -->
    <div class="modal fade text-center" id="AboutBrainy" tabindex="-1" role="dialog" aria-labelledby="AboutBrainy" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AboutBrainy">About Brainy!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="text-align: start;">
                        The Brainy game is a memory pairing game. It is a great starter for children
                        challenging their mind skills. Wherein we have 10 attempts to complete the
                        game and 4 pairs and 1 joker in a total of 9 cards. The user must click the
                        correct 4 pairs to complete the game, when the user did not click the same pair
                        it will go back to the normal state until you find the same pair.
                        <br>
                        <br>
                        The reference to this game was in my ICS26011(Mobile Programming) course and
                        also our professor is Ma’am Alma Perol. It was the last project as a mobile
                        application game that was needed in the course. We implement it on our website
                        as one of the three games stated.
                        <br>
                        <br>
                        <i>-Cited by James Adrian Ramasta</i>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal About Lucky Number -->
    <div class="modal fade" id="AboutLuckyNumber" tabindex="-1" role="dialog" aria-labelledby="AboutLuckyNumber" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AboutLuckyNumber">About Lucky Number</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="text-align: start;">Lucky game is a php-based activity in which you can enter a number
                        and try to guess whatever will generate a random number, then count the attempts.
                        <br>
                        <br>
                        Our group came up with the idea from our previous php activity, which was provided to us to try, 
                        and it's simple and easy on the children's eye sign, as our primary audience is children. 
                        This game is simple and straightforward, and I keep hoping everyone enjoys it and finds 
                        it enjoyable.
                        <br>
                        <br>
                        <i>-Cited by Kwan Dwight Kwan</i>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal About Spell Me -->
    <div class="modal fade" id="AboutSpellMe" tabindex="-1" role="dialog" aria-labelledby="AboutSpellMe" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AboutSpellMe">About Spell Me</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="text-align: start;">Spell Me is a mini game that aims to help people,
                        especially the children, learn the correct spelling of words that are easily mistaken or interchanged.
                        <br>
                        <br>
                        This game was inspired and a mini version of the given we had submitted in another course.
                        The activity was our final project given by our most beloved professor, ma'am Alma Perol for
                        the course ICS26011 (Mobile Programming).
                        <br>
                        <br>
                        <i>-Cited by Allen Christopher Guelas</i>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>