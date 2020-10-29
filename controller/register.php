<?php

    include "connect.php";

    if(!($_SERVER["REQUEST_METHOD"] === "POST")) {
        header("Location: index.php");
    }
        $username = $_POST["username"];
        $userpassword = $_POST["password"];
        $pwd = hash('sha512', $userpassword);
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $sql_u = "SELECT * FROM users WHERE username = '{$username}'";
        $sql_e = "SELECT * FROM users WHERE email = '{$email}'";
        $res_u = $conn->query($sql_u);
        $res_e = $conn->query($sql_e);

        if($res_u->num_rows > 0){
            echo json_encode(array("statusCode"=>409));
        } else if($res_e->num_rows > 0){
            echo json_encode(array("statusCode"=>422));
        }else{
            $sql = "INSERT INTO users 
                (username,userpassword,fullname,email) 
                VALUES ('{$username}', '{$pwd}', '{$fullname}', '{$email}')";
            $conn->query($sql);
            echo json_encode(array("statusCode"=>200));
        }

?>
