<?php

    include "connect.php";

    if(!($_SERVER["REQUEST_METHOD"] === "POST")) {
        header("Location: ../pages/settings.php");
    }
    $username = $_POST["username"];
    $old = $_POST["oldPwd"];
    $new = $_POST["newPwd"];

    $oldPwd = hash('sha512', $old);

        $sql = "SELECT * FROM users WHERE username = '{$username}' AND userpassword = '{$oldPwd}'";
        $result = $conn->query($sql);

        if($result->num_rows == 0) {
            echo json_encode(array("statusCode"=>401));
        }
        else {
            $newPwd = hash('sha512',$new);
            $sql1 = "UPDATE users SET userpassword = '{$newPwd}' WHERE username = '{$username}'";
            $result1 = $conn->query($sql1);
            if($result1 === TRUE){
                echo json_encode(array("statusCode"=>200));
            }else{
                echo json_encode(array("statusCode"=>400));
            }
        }
?>