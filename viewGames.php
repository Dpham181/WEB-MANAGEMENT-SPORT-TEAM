<?php
      require_once('config.php');
      // Connect to database

      /* Attempt to connect to MySQL database */
      $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

      // Check connection
      if($link === false){
          die("ERROR: Could not connect. " . mysqli_connect_error());
      }

      $query ="SELECT
             PLAY.PGAME_ID,
             PLAY.PTEAM_ID,
             PLAY.SCORE
             FROM PLAY
             ORDER BY PLAY.PGAME_ID";

    $stmt = $link->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result(
    $ID,
    $TID,
    $S



  );


  while($stmt->fetch()){

    echo "<tr>\n";
    echo "<td>".$ID."</td>\n";
    echo "<td>".$TID."</td>\n";
    echo "<td>".$S."</td>\n";


  }


  $stmt->free_result();

  $link->close();
?>
