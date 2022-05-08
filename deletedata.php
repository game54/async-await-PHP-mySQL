<?php
require_once "db.php";


$car = $_GET["q"];
// var_dump($car);

// sql to delete a record
$sql = "DELETE FROM cars WHERE carname= '$car' ";

// var_dump($sql);
// echo $conn->affected_rows

if (mysqli_query($conn, $sql) && $conn->affected_rows > 0) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}

$conn->close();