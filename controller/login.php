<?php

    include "connect.php";

    if(!($_SERVER["REQUEST_METHOD"] === "POST")) {
        header("Location: index.php");
    }
    $username = $_POST["username"];
    $userpassword = $_POST["password"];
    $pwd = hash('sha512', $userpassword);
    $remember = $_POST["remember"];

        $sql = "SELECT * FROM users WHERE username = '{$username}' AND userpassword = '{$pwd}'";
        $result = $conn->query($sql);

        if($result->num_rows == 0) {
            echo json_encode(array("statusCode"=>404));
        }
        else {
            if($remember == "true") {
                setcookie('username', $username, time() + 3600, '/');
                setcookie('pwd', $userpassword, time() + 3600, '/');
            }
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['pwd']  = $pwd;
            echo json_encode(array("statusCode"=>200));
        }
?>