
<?php

include "connect.php";

if (!($_SERVER["REQUEST_METHOD"] === "POST")) {
    header("Location: ../pages/expenses.php");
}
$id = $_POST["id"];

$sql = "DELETE FROM expenses WHERE id = '$id'";
$result = $conn->query($sql);

if (!$sql) {
    echo json_encode(array("statusCode" => 500));
} else {
    echo json_encode(array("statusCode" => 200));
}
?>