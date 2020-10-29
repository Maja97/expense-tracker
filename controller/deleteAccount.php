
<?php

include "connect.php";

if (!($_SERVER["REQUEST_METHOD"] === "POST")) {
    header("Location: ../pages/settings.php");
}
$username = $_POST["username"];

$sql = "DELETE FROM expenses WHERE username = '$username'";
$result = $conn->query($sql);


$sql1 = "DELETE FROM users WHERE username = '$username'";
$result1 = $conn->query($sql1);

if (!$sql || !$sql1) {
    echo "Error";
} else {
    echo 200;
}
?>