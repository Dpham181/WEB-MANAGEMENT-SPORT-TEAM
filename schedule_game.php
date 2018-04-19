<!DOCTYPE html>
<html>
  <head>
    <title>schedule</title>
  </head>
  <body>
    <h1 >Schedule all Games</h1>

    <?php
      require_once('config.php');
      // Connect to database

      /* Attempt to connect to MySQL database */
      $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

      // Check connection
      if($link === false){
          die("ERROR: Could not connect. " . mysqli_connect_error());
      }

      $query = "SELECT G.GAME_ID, G.START_DAY, G.END_DAY, T.TEAM_NAME, T.WIN, T.LOSS
      FROM PLAY P, GAMES G, TEAMS T
      WHERE T.TEAM_ID = P.PTEAM_ID AND G.GAME_ID = P.PGAME_ID
      ORDER BY GAME_ID;";

      if ($stmt = $link->prepare($query)) {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result(
          $GID,
          $STD,
          $ETD,
          $TN,
          $W,
          $L
        );
      }
    ?>


    <?php
      $row = (int) $stmt->num_rows / 2;
      echo "GAME:  ".$row. "<br/>";
    ?>


    <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr class="info">
          <th scope="col">GAME</th>
          <th scope="col">START TIME</th>
          <th scope="col">END TIME</th>

          <th scope="col">TEAM NAME</th>
          <th scope="col">WIN</th>
          <th scope="col">LOSS</th>

          <th scope="col">TEAM NAME</th>
          <th scope="col">WIN</th>
          <th scope="col">LOSS</th>
        </tr>
      </thead>
      <?php

        while($stmt->fetch()){

          echo "<tr>\n";
          echo "<th scope=\"row\">".$GID."</th>\n";
          echo "<td>".$STD."</td>\n";
          echo "<td>".$ETD."</td>\n";

          echo "<td>".$TN."</td>\n";
          echo "<td>".$W."</td>\n";
          echo "<td>".$L."</td>\n";

          $stmt->fetch();
          echo "<td>".$TN."</td>\n";
          echo "<td>".$W."</td>\n";
          echo "<td>".$L."</td>\n";
          echo "</tr>";

        }

        $stmt->free_result();

        $link->close();

      ?>

    </table>

  </body>
</html>
