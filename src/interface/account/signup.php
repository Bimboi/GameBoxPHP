<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("../../classes/Connection.php");
include_once("../../classes/User.php");

$con = new Connection();
$user = new User();
$result;

if (isset($_POST['username_signup'])) {
    $con->setConnection();
    $result = $user->signUp($_POST['username_signup'], $_POST['password_signup'], $con->getConnection());
    
    unset($_POST['username_signup']);
    unset($_POST['password_signup']);

    if ($result == 0) {
        $_SESSION['signupOK'] = "Yes";
        header("Location: signin.php");
    } else {
        $_SESSION['signupOK'] = "No";
        header("Location: " . $_SERVER['PHP_SELF']);
    }

    die;
}

// include("../../utils/connection.php");
// include("../../utils/account_functions.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link href="../../../asset/design.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>

<body class="wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <aside class="col-sm-4">

                <div class="card">
                    <article class="card-body" style="margin: 6px;">
                        <h4 class="card-title text-center mb-4 mt-1">Sign in</h4>
                        <hr>
                        <?php 
                        if (isset($_SESSION['signupOK']) && $_SESSION['signupOK'] == "No") {
                            $_SESSION['signupOK'] = "Reset";
                            echo "<p class='text-danger text-center'>Username already exists</p>";
                        }
                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    </div>
                                    <input name="username_signup" class="form-control" placeholder="Username" type="text" maxlength="20" required>
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                    </div>
                                    <input name="password_signup" class="form-control" placeholder="******" type="password" minlength="6" maxlength="20" required>
                                </div>
                            </div> 
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Create </button>
                            </div> 
                            <p class="text-center"><a href="signin.php" class="btn">Already have an account?</a></p>
                        </form>
                    </article>
                </div>
            </aside>
        </div>
    </div>
</body>

</html>