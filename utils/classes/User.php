<?php

class User
{
    private $username = $_SESSION['user_name'];
    private $password = $_SESSION['password'];
    private $db_connection;

    function setUsername($newName)
    {
        $query = "update users set user_name='$newName' where user_name='$this->username'";
        mysqli_query($this->db_connection, $query);
        $this->username = $newName;
    }

    function getUsername()
    {
        return $this->username;
    }

    function setPassword($newPass)
    {
        $query = "update users set user_name='$newPass' where user_name='$this->username'";
        mysqli_query($this->db_connection, $query);
        $this->password = $newPass;
    }

    function getPassword()
    {
        return $this->password;
    }

    function signUp($name, $password, $con)
    {
        $name = $_POST['username_signup'];
        $password = $_POST['password_signup'];

        unset($_POST['username_signup']);
        unset($_POST['password_signup']);

        //read from database
        $query = "select * from users where user_name = '$name' limit 1";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 0) {

            $user_id = random_num(20);
            $query = "insert into users (user_id,user_name,password) values ('$user_id','$name','$password')";

            mysqli_query($con, $query);

            $_SESSION['signupOK'] = "Yes";
            header("Location: signin.php");
            die;
        } else {
            $_SESSION['signupOK'] = "No";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }

    function signIn($name, $password, $con)
    {
        $name = $_POST['username_signin'];
        $password = $_POST['password_signin'];

        unset($_POST['username_signin']);
        unset($_POST['password_signin']);
        //read from database
        $query = "select * from users where user_name = '$name' limit 1";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {

            $user_data = mysqli_fetch_assoc($result);

            if ($user_data['password'] === $password) {

                $_SESSION['signinOK'] = "Yes";
                $_SESSION['user_name'] = $user_data['user_name'];
                header("Location: ../index.php");
                die;
            } else {
                $_SESSION['signinOK'] = "No";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }
        } else {
            $_SESSION['signinOK'] = "No";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }

    function singOut() {
        $_SESSION['signinOK'] = "No";
        unset($_SESSION['user_name']);
        unset($_SESSION['password']);

        header("Location: account/signin.php");
        die;
    }

    function random_num($length)
    {
        $text = "";
        if ($length < 5) {
            $length = 5;
        }

        $len = rand(4, $length);

        for ($i = 0; $i < $len; $i++) {
            $text .= rand(0, 9);
        }

        return $text;
    }
}
