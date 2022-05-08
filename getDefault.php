<?php
require_once "db.php";

// var_dump($_GET);

$sql = "SELECT carname,id FROM cars";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      echo "<li>" . $row["id"] . ". " . $row["carname"] . "</li>";
  }
} else {
  echo "0 results";
}
$conn->close();