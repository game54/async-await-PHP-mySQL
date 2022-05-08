<?php

$cars = array("Subaru", "Mercedes", "Mitsubishi", "Opel");

$bikes = array("Ducati", "Yahama", "Honda");

if($_GET["q"] === "cars"){
  foreach ($cars as $index => $car){
    // echo "<li>$index. $car</li>";
    echo "<li>" ;
    echo $index+1 . ". " . $car;
    echo "</li>";
  }
  }


if($_GET["q"] === "bikes"){
foreach ($bikes as $index => $bike){
  // echo "<li>$bike</li>";
  echo "<li>" ;
  echo $index+1 . ". " . $bike;
  echo "</li>";
}
}