<?php
require_once "db.php";

$sql = "SELECT carname,id FROM cars";
$result = $conn->query($sql);


?>


<!DOCTYPE html>
<html>

<head>
  <script>
  function showHint(str) {
    if (str.length == 0) {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "/gethint.php?q=" + str, true);
      xmlhttp.send();
      console.log("done");
    }
  }
  </script>
  <script src="https://kit.fontawesome.com/981839843c.js" crossorigin="anonymous"></script>
</head>

<body style="background-color: #aaa">
  <p><b>Start typing a name in the input field below:</b></p>
  <form action="">
    <label for="fname">First name:</label>
    <input type="text" id="fname" name="fname" onkeyup="showHint(this.value)" />
  </form>
  <p>Suggestions: <span id="txtHint"></span></p>
  <br>
  <br>
  <br>
  <div class="container" style="display: flex;
    justify-content: center;">
    <div>
      <button class="bikes">bikes</button>
      <button class="cars">cars</button>
      <button class="default">default</button>
      <button class="clear">clear</button>
      <div class="parent" style="min-height: 300px;">
        <ul style="padding:50px;list-style:none;">
          <?php
    if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      echo "<li>" . $row["id"] . ". " . $row["carname"]?>
          <!-- <i class="fa fa-cat" style="margin-left:50px;"></i> -->
          <?php "</li>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
        </ul>
      </div>

      <form name="myForm" action="" method="post">
        <label for="carname">car name:</label>
        <input type="text" id="carname" name="carname" />
        <button type="submit" id="submitcar">Submit</button>
        <button id="delete">Delete</button>
      </form>

      <div class="info" style="margin-top:30px;"></div>
    </div>
  </div>
  <script>
  async function ajaxCalls(query) {

    const response = await fetch(`getdata.php?q=${query}`, {
      method: "GET",
      // body: `carname=${carname}`,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    })

    const data = await response.text();

    document.querySelector(".parent ul").innerHTML = data;

  }
  async function ajaxCallsDefault() {

    const response = await fetch("getDefault.php", {
      method: "GET",
      // body: `carname=${carname}`,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    })

    const data = await response.text();

    document.querySelector(".parent ul").innerHTML = data;

  }

  const btn = document.querySelector(".bikes").addEventListener("click", () => {

    ajaxCalls("bikes");

  });

  const btn2 = document.querySelector(".cars").addEventListener("click", () => {

    ajaxCalls("cars");

  });

  const defaultBtn = document.querySelector(".default").addEventListener("click", () => {

    ajaxCallsDefault();

  });

  const clear = document.querySelector(".clear").addEventListener("click", () => {

    document.querySelector(".parent ul").innerHTML = "";

  });


  // FETCH API
  async function fetchPost() {
    const carName = document.querySelector("#carname");
    const carname = (carName.value);
    const response = await fetch('insertdata.php', {
      method: "POST",
      body: `carname=${carname}`,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    })

    const data = await response.text();
    document.querySelector(".info").innerHTML = data;

    setTimeout(function() {
      document.querySelector(".info").innerHTML = "";
    }, 3000)

    ajaxCallsDefault();
    carName.value = "";
  }
  const submitCarBtn = document.querySelector("#submitcar");
  submitCarBtn.addEventListener("click", (e) => {
    e.preventDefault();

    fetchPost();


  })

  async function ajaxCallsDelete() {
    const carName = document.querySelector("#carname");
    const carname = (carName.value);

    const response = await fetch(`deletedata.php?q=${carname}`, {
      method: "GET",
      // body: `carname=${carname}`,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    })

    const data = await response.text();

    document.querySelector(".info").innerHTML = data;

    setTimeout(function() {
      document.querySelector(".info").innerHTML = "";
    }, 3000)

    ajaxCallsDefault();
    carName.value = "";
  }

  const deleteBtn = document.querySelector("#delete").addEventListener("click", (e) => {
    e.preventDefault();
    ajaxCallsDelete()

  });
  </script>
</body>

</html>