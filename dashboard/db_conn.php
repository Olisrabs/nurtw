<?php
// database connection: username, password, database name
  $conn = new mysqli("localhost", "wetinde3_isuser", "olisrab@25", "wetinde3_israeldb");
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
?>