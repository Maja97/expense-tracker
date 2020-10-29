<?php
    include "connect.php";

    if(!($_SERVER["REQUEST_METHOD"] === "POST")) {
        header("Location: ../pages/expenses.php");
    }

    $username = $_POST['username'];
    $sql = "SELECT * FROM expenses WHERE username='$username'";
    $result = $conn->query($sql);
    $expensesList = array();
    if (!$sql) {
        echo "Error";
    } else{
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $expensesList[] = $row;
        }
        echo (json_encode($expensesList));
    }else echo "Error";
}
?>