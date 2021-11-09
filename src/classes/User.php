<?php

class User
{
    private $username;
    private $password;
    private $db_connection;

    function __construct()
    {
        $this->username = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "";
        $this->password = isset($_SESSION['password']) ? $_SESSION['password'] : "";
    }

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
        //read from database
        $query = "select * from users where user_name = '$name' limit 1";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 0) {

            $user_id = $this->random_num(20);
            $query = "insert into users (user_id,user_name,password) values ('$user_id','$name','$password')";

            mysqli_query($con, $query);

            return 0;
        } else {
            return 1;
        }
    }

    function signIn($name, $password, $con)
    {
        //read from database
        $query = "select * from users where user_name = '$name' limit 1";
        $result = mysqli_query($con, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {

            $user_data = mysqli_fetch_assoc($result);

            if ($user_data['password'] === $password) {
                return $user_data;
            } else {
                return 1;
            }
        } else {
            return 1;
        }
    }

    function signOut() {
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
