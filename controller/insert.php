<?php

    include "connect.php";

    if(!($_SERVER["REQUEST_METHOD"] === "POST")) {
        header("Location: ../pages/expenses.php");
    }
    $username = $_POST["username"];
    $item = $_POST["item"];
    $price = $_POST["price"];
    $date = $_POST["date"];
    $category = $_POST["category"];


        $sql = "INSERT INTO expenses(item,price,purchase_date,category,username) VALUES ('$item','$price','$date','$category','$username')";
        $result = $conn->query($sql);
        $id = $conn->insert_id;
        if(!$sql){
            echo "Error";
        }
        else {
            echo $id;
        }
?>