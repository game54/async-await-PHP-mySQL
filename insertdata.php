<?php
require_once "db.php";


// var_dump($_POST);

$dataName = $_POST["carname"];


$sql = "INSERT INTO cars (carname)
VALUES ('$dataName')";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);