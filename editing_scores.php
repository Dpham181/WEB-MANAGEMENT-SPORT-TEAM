<?php
  require_once('./config.php');
  require_once('update_scores.php');
  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if ($db === false) {
    die("ERROR: COULD NOT CONNECT. ".mysqli_connect_error());
  }


 ?>

  <table style="margin: 0px auto; border: 0px; border-collapse:separate;">
    <td style="text-align: right; background: lightblue;">Game ID</td>
    <td>
      <select name="edit-score-gameid" required>

                 <option value="" selected disabled hidden>Choose GAME ID  here</option>
                 <?php

                 $query = "SELECT DISTINCT PGAME_ID FROM PLAY";

                 $stmt = $db->prepare($query);
                 $stmt->execute();
                 $stmt->store_result();
                 $stmt->bind_result(
                  $game_id
                 );
                   $stmt->data_seek(0);
                    while( $stmt->fetch())
                    {
                      echo "<option value=\"edit-$game_id\">".$game_id."</option>\n";

                    }
                  $stmt->free_result();
                    ?>
      </select>

    </td>
    <td style="text-align: right; background: lightblue;">Team ID</td>
    <td>
      <select name="edit-score-teamid" required>

                 <option value="" selected disabled hidden>Choose Team ID  here</option>
                 <?php

                 $query = "SELECT DISTINCT PTEAM_ID FROM PLAY";

                 $stmt = $db->prepare($query);
                 $stmt->execute();
                 $stmt->store_result();
                 $stmt->bind_result(
                  $team_id
                 );
                   $stmt->data_seek(0);
                    while( $stmt->fetch())
                    {
                      echo "<option value=\"edit-$team_id\">".$team_id."</option>\n";

                    }
                    ?>
      </select>

    </td>
    <td style="text-align: right; background: lightblue;">Score</td>
    <td><input type="text" name="edit-score" value="" size="5" maxlength="5"/></td>
    <td colspan="2" style="text-align: center;"><input type="submit" value="submit" /></td>
  </tr>

  </table>
