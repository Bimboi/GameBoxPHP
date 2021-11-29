<?php

class User
{
    private $username;
    private $password;
    private $db_connection;

    function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
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

    function signUp($con)
    {
        $query = "select * from users where user_name = '$this->username' limit 1";
        $result = mysqli_query($con, $query);

        if ($result and mysqli_num_rows($result) == 0) {
            $query = "insert into users (user_name,password) values ('$this->username','$this->password')";
            $result = mysqli_query($con, $query);
        }
        return $result;
    }

    function signIn($con)
    {
        $query = "select * from users where user_name = '$this->username' limit 1";
        $result = mysqli_query($con, $query);

        if ($result and mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if ($user_data and $user_data['password'] === $this->password) {
                return $user_data;
            }
        }
        return false;
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
