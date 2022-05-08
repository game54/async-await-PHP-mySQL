<?php
require_once "db.php";


$car = $_GET["q"];
// var_dump($car);

// sql to delete a record
$sql = "DELETE FROM cars WHERE carname= '$car' ";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();