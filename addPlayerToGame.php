<?php
  require_once 'config.php';
  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  // Check connection
  if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }


 ?>