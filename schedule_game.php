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

        $sql= "SELECT

              GAMES.START_DAY,
              GAMES.END_DAY,

              FROM PLAY
              RIGHT JOIN GAMES ON
              PLAY.PGAME_ID = GAMES.GAME_ID
              GROUP BY GAMES.GAME_ID

          ";
          $sql1= "SELECT


              TEAMS.TEAM_NAME,
              TEAMS.WIN,
              TEAMS.LOSS,
              ROUND ((TEAMS.WIN /(TEAMS.WIN +TEAMS.LOSS) * 100) ,0)  AS PERSENTAGE


              FROM PLAY
              RIGHT JOIN TEAMS ON
              PLAY.PTEAM_ID= TEAMS.TEAM_ID


            ";
      if ($stmt =  $link->prepare($sql) && $stmt1 = $link->prepare($sql1)) {
        echo 'true';
        $stmt -> execute();
        $stmt->store_result();
        $stmt->bind_result(
          $STD,
          $ETD,
          $SC);
        $stmt1 -> execute();
        $stmt1->store_result();
        $stmt1->bind_result(
          $TN,
          $W,
          $L,
          $PERSENT
        );

      }
    ?>


    <?php
      if ($stmt =  $link->prepare($sql) && $stmt1 = $link->prepare($sql1)) {
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
          <th scope="col">% WIN</th>

          <th scope="col">TEAM NAME</th>
          <th scope="col">WIN</th>
          <th scope="col">LOSS</th>
          <th scope="col">% WIN</th>
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
        if ($stmt =  $link->prepare($sql) && $stmt1 = $link->prepare($sql1)) {
        $row = 0;

        while($stmt->fetch()){

          echo "<tr>\n";


          echo "<th scope=\"row\">".++$row."</th>\n";
          echo "<td>".$STD."</td>\n";
          echo "<td>".$ETD."</td>\n";
          echo "<td>".$SC."</td>\n";

          for ($i=0; $i < 2 ; $i++) {
            $stmt1->fetch();
            echo "<td>".$TN."</td>\n";
            echo "<td>".$W."</td>\n";
            echo "<td>".$L."</td>\n";
            echo "<td>".$PERSENT."</td>\n";
          }
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

        $stmt1->free_result();






        $link->close();
      }

      ?>

    </table>

  </body>
</html>
