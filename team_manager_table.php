<?php
  require_once 'config.php';
  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if ($db === false) {
    die("ERROR: COULD NOT CONNECT".mysqli_connect_error());
  }

  $query = "SELECT MANAGER_ID, EMAIL FROM MANAGER, USERS WHERE TYPE = 'M' AND MUSER_ID = USER_ID";
  $stmt = $db->prepare($query);
  $stmt->execute();
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>MANAGER TABLE</title>
   </head>
   <body>
     <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr class="info">
          <th scope="col">MANAGER ID</th>
          <th scope="col">EMAIL</th>
        </tr>
      </thead>

   </body>
 </html>
