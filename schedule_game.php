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

      $query = " SELECT
        G.GAME_ID,G.START_DAY, G.END_DAY,
        T1.TEAM_NAME, T1.WIN, T1.LOSS,
        T2.TEAM_NAME, T2.WIN, T2.LOSS
        FROM
        GAMES as G,
        TEAMS as T1,
        TEAMS as T2,
        PLAY  as P
        WHERE
        G.GAME_ID   = P.PGAME_ID AND
        (P.PTEAM_ID = T1.TEAM_ID OR P.PTEAM_ID = T2.TEAM_ID) AND
        T1.TEAM_ID != T2.TEAM_ID
        GROUP BY
        G.GAME_ID
        ORDER BY
        G.START_DAY,
        T1.TEAM_NAME;
        ";

      if ($stmt = $link->prepare($query)) {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result(
          $GID,
          $STD,
          $ETD,
          $TN1,
          $W1,
          $L1,
          $TN2,
          $W2,
          $L2
        );
      }
    ?>


    <?php
      if ($stmt =  $link->prepare($query)) {
        echo "GAME:  ".$stmt->num_rows. "<br/>";
      }
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
          <!-- <th scope="col">% WIN</th> -->

          <th scope="col">TEAM NAME</th>
          <th scope="col">WIN</th>
          <th scope="col">LOSS</th>
          <!-- <th scope="col">% WIN</th> -->
        </tr>
      </thead>
        <!-- <tr>
          <th style="vertical-align:top; border:1px solid black; background: lightgreen;">GAME</th>
          <th style="vertical-align:top; border:1px solid black; background: lightgreen;">START_DAYS</th>
          <th style="vertical-align:top; border:1px solid black; background: lightgreen;">END_DAYS</th>

          <th style="vertical-align:top; border:1px solid black; background: lightgreen;">TEAM A NAME</th>
          <th style="vertical-align:top; border:1px solid black; background: lightgreen;">WIN  </th>
          <th style="vertical-align:top; border:1px solid black; background: lightgreen;">LOSS</th>
          <th style="vertical-align:top; border:1px solid black; background: lightgreen;">% WIN</th>

          <th style="vertical-align:top; border:1px solid black; background: lightgreen;">TEAM B NAME</th>
          <th style="vertical-align:top; border:1px solid black; background: lightgreen;">WIN  </th>
          <th style="vertical-align:top; border:1px solid black; background: lightgreen;">LOSS</th>
          <th style="vertical-align:top; border:1px solid black; background: lightgreen;">% WIN</th>
        </tr> -->


      <?php
        // if ($stmt =  $link->prepare($query)) {
        $row = 0;

        echo "<tr>\n";


          echo "<th scope=\"row\">".$GID."</th>\n";
          echo "<td>".$STD."</td>\n";
          echo "<td>".$ETD."</td>\n";

          echo "<td>".$TN1."</td>\n";
          echo "<td>".$W1."</td>\n";
          echo "<td>".$L1."</td>\n";

          echo "<td>".$TN2."</td>\n";
          echo "<td>".$W2."</td>\n";
          echo "<td>".$L2."</td>\n";
        echo "</tr>\n";
        while($stmt->fetch()){

          echo "<tr>\n";


          echo "<th scope=\"row\">".$GID."</th>\n";
          echo "<td>".$STD."</td>\n";
          echo "<td>".$ETD."</td>\n";

          echo "<td>".$TN1."</td>\n";
          echo "<td>".$W1."</td>\n";
          echo "<td>".$L1."</td>\n";

          echo "<td>".$TN2."</td>\n";
          echo "<td>".$W2."</td>\n";
          echo "<td>".$L2."</td>\n";
            // echo "<td>".$PERSENT."</td>\n";
        //   $stmt1->fetch();
        // echo "<td  style='vertical-align:top; border:1px solid black;'>". $TN ."</td>\n";
        // echo "<td style='vertical-align:top; border:1px solid black;'> ". $W ."</td>\n";
        //   echo "<td style='vertical-align:top; border:1px solid black;'>". $L ."</td>\n";
        //     echo "<td style='vertical-align:top; border:1px solid black;'>". $PERSENT . '%' ."</td>\n";
        //   $stmt1->fetch();
        //   echo "<td  style='vertical-align:top; border:1px solid black;'>". $TN ."</td>\n";
        //   echo "<td style='vertical-align:top; border:1px solid black;'> ". $W ."</td>\n";
        //   echo "<td style='vertical-align:top; border:1px solid black;'>". $L ."</td>\n";
        //   echo "<td style='vertical-align:top; border:1px solid black;'>". $PERSENT . '%' ."</td>\n";



          echo "</tr>";

}



        $stmt->free_result();







        $link->close();
      // }

      ?>

    </table>

  </body>
</html>
