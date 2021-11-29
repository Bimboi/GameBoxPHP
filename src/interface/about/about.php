<?php
// if (!isset($_SESSION)) {
//     session_start();
// }

// include_once("../../classes/Connection.php");
// include_once("../../classes/GamePlatform.php");
// include_once("../../classes/Constants.php");

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About GameBox</title>
    <link href="../../../asset/design.css" rel="stylesheet">
    <link href="../../../asset/button.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>

<body class="wrapper">
    <div class="about-resize container-fluid container-outer" style="height:100%;">
        <header style="width: fit-content;">
            <div class="card">
                <article class="card-body mt-0">
                    <h3 class="card-title text-right mb-0 mt-0"><a href="../games/main_index.php" class="nav-header" style="color: black;">Back to Home</a>
                    </h3>
                </article>
            </div>
        </header>
        <section class="container-fluid container-inside text-center">
            <div class="card item">
                <article class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-sm-8">

                            <h1 class="card-title text-center mt-5 mb-5" style="font-weight: bold; font-size:60px"><span style="color: grey;">Game</span><span style="color: black;">Box</span>
                                <sup>
                                    <sup class="about-game" style="font-size:small; font-weight:medium; margin-left: -15px">2021
                                    </sup>
                                </sup>
                            </h1>
                            <p class="text-center" style="font-size: 20px">GameBox is a compilation of simple simulation games.<br>It is a great starter for
                                children challenging their mind skill.<br>
                                It is inspired by former activities and projects from
                                Ma’am Perol.</p>
                            <br>
                        </div>
                    </div>
                    <hr>
                    <h2 class="card-title text-center mt-5 mb-5" style="font-weight: bold;">
                        Meet the developers
                    </h2>
                    <div class="row mt-5 mb-5 justify-content-center">
                        <div class="col-sm-5" style="padding: 25px;">
                            <img class="img-about" src="../../../asset/images/James_Dev.jpg" />
                            <h3 class="mt-5 mb-4">James Adrian Ramasta</h3>
                            <p style="font-size: 20px">I am a fourth-year IT student from the University of Santo Tomas.
                                This is the final project in ITELEC3C (WEB APPLICATIONS DEVELOPMENT USING PHP)
                                creating a website using PHP. I would like to take this opportunity to thank Ma’am Alma Perol
                                for new learnings, new knowledge, and new skills that I might be needed in the future.</p>
                        </div>
                        <div class="col-sm-5" style="padding: 25px;">
                            <img class="img-about" src="../../../asset/images/Mark_Dev.jpg" />
                            <h3 class="mt-5 mb-4">Mark Anthony Caldoza</h3>
                            <p style="font-size: 20px">I am currently a 4th year information technology student from University of Santo Tomas.
                                PHP course is important in web developing. Thankfully, our hardworking professor Ma'am Alma Perol made it simple to learn.</p>
                        </div>
                    </div>
                    <div class="row mt-5 mb-5 justify-content-center">
                        <div class="col-sm-5" style="padding: 25px;">
                            <img class="img-about" src="../../../asset/images/Venz_Dev.jpg" />
                            <h3 class="mt-5 mb-4">Venz Dwight Kwan</h3>
                            <p style="font-size: 20px">I'm a fourth year student BSIT in University of Santo Tomas Manila. 
                            I lived in Bacoor, Cavite. To our beloved Professor Alma Perol thank you for sharing your 
                            knowledge to us we love you Ma'am Perol. Ang kaba ay nasa isip lamang parang gutom lumilipas din.</p>
                        </div>
                        <div class="col-sm-5" style="padding: 25px;">
                            <img class="img-about" src="../../../asset/images/Allen_Dev.jpg" />
                            <h3 class="mt-5 mb-4">Allen Christopher Guelas</h3>
                            <p style="font-size: 20px">I am a fourth year college student from University of Santo Tomas. 
                            This project is a partial fulfilment for our elective course.</p>
                        </div>
                    </div>
                </article>
            </div>
        </section>
        <footer class="container-footer ">
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
</body>

</html>