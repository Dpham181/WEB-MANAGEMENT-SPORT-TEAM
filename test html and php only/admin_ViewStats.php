<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>View Stats</title>
  </head>
  <body>
    <?php
  require_once('./config.php');

  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if ($db === false) {
    die("ERROR: COULD NOT CONNECT. ".mysqli_connect_error());
  }

  $query = "SELECT
  P.PLAYER_ID, P.FIRST_NAME, P.LAST_NAME, SUM(PLAYINGTIMEMIN), SUM(PLAYINGTIMESEC), SUM(POINTS), SUM(ASSISTS), SUM(REBOUNDS), SUM(THREE_POINTS), SUM(FTA), SUM(STEAL), SUM(FOUL), (BLOCK), SUM(FTM)
  FROM PLAYER P  LEFT JOIN STATS S ON
  P.PLAYER_ID = S.SPLAYER_ID
  GROUP BY P.PLAYER_ID
  ORDER BY  P.LAST_NAME";

  $stmt = $db->prepare($query);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result(
    $player_id,
    $first_name,
    $last_name,
    $playing_time_min,
    $playing_time_sec,
    $points,
    $assits,
    $rebounds,
    $three_points,
    $fta,
    $steal,
    $foul,
    $block,
    $ftm
  );
  ?>

  <table class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr class="info">
          <th scope="col">PLAYER ID</th>
          <th scope="col">FIRST NAME</th>
          <th scope="col">LAST NAME</th>
          <th scope="col">MINUTE</th>
          <th scope="col">SECOND</th>
          <th scope="col">POINTS</th>
          <th scope="col">ASSISTS</th>
          <th scope="col">REBOUNDS</th>
          <th scope="col">THREE POINTS</th>
          <th scope="col">FTA</th>
          <th scope="col">STEAL</th>
          <th scope="col">FOUL</th>
          <th scope="col">BLOCK</th>
          <th scope="col">FTM</th>
        </tr>
      </thead>

      <?php




      $toggle = "table-active";
      $switch_color = false;

        while ($stmt->fetch()) {
          if ($switch_color) {
            $toggle = "table-success";
            $switch_color = false;
          } else {
            $toggle = "table-light";
            $switch_color = true;
          }
          echo "<tr class=\"$toggle\">\n";
          echo "<td>".$player_id."</td>\n";
          echo "<td>".$first_name."</td>\n";
          echo "<td>".$last_name."</td>\n";
          echo "<td>".$playing_time_min."</td>\n";
          echo "<td>".$playing_time_sec."</td>\n";
          echo "<td>".$points."</td>\n";
          echo "<td>".$assits."</td>\n";
          echo "<td>".$rebounds."</td>\n";
          echo "<td>".$three_points."</td>\n";
          echo "<td>".$fta."</td>\n";
          echo "<td>".$steal."</td>\n";
          echo "<td>".$foul."</td>\n";
          echo "<td>".$block."</td>\n";
          echo "<td>".$ftm."</td>\n";
        }
       ?>

  </table>
  <td style="vertical-align:top; border:1px solid black;">
          <!-- FORM to enter game statistics for a particular player -->
          <form action="processStatisticUpdate.php" method="post">
            <table style="margin: 0px auto; border: 0px; border-collapse:separate;">
              <tr>
                <td style="text-align: right; background: lightblue;">Name (Last, First)</td>
<!--            <td><input type="text" name="name" value="" size="50" maxlength="500"/></td>  -->
                <td><select name="name_ID" required>
                  <option value="" selected disabled hidden>Choose player's name here</option>
                  <?php
      $stmt->data_seek(0);
      require_once('Address.php');
                     while( $stmt->fetch() )
                     {
                       $player = new Address([$first_name, $last_name]);
                       echo "<option value=\"$player_id\">".$player->name()."</option>\n";
                     }
                   ?>
                 </select></td>
               </tr>

               <tr>
                 <td style="text-align: right; background: lightblue;">Playing Time (min:sec)</td>
                <td><input type="text" name="time" value="" size="5" maxlength="5"/></td>
               </tr>

               <tr>
                 <td style="text-align: right; background: lightblue;">Points Scored</td>
                <td><input type="text" name="points" value="" size="3" maxlength="3"/></td>
               </tr>

               <tr>
                 <td style="text-align: right; background: lightblue;">Assists</td>
                 <td><input type="text" name="assists" value="" size="2" maxlength="2"/></td>
               </tr>

               <tr>
                 <td style="text-align: right; background: lightblue;">Rebounds</td>
                 <td><input type="text" name="rebounds" value="" size="2" maxlength="2"/></td>
               </tr>

               <tr>
                <td colspan="2" style="text-align: center;"><input type="submit" value="Add Statistic" /></td>
               </tr>
             </table>
           </form>
         </td>
       </tr>
     </table>

  </body>
</html>
