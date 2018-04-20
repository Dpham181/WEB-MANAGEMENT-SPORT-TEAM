<?php
  require_once 'config.php';
  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  if ($db === false) {
    die("ERROR: COULD NOT CONNECT".mysqli_connect_error());
  }

  if (isset($_GET['player_id']) && isset($_GET['game_id'])) {
    $player_id = (int) $_GET['player_id'];
    $game_id = (int) $_GET['game_id'];
    // echo "$player_id\n";
    // echo "$game_id";
    $query = "DELETE FROM STATS WHERE SPLAYER_ID = ? AND SGAME_ID = ?";
    $stmt = $db->prepare($query);
    // $stmt->bind_param('ii', $player_id, $game_id);
    $stmt->bind_param('ii', $player_id, $game_id);
    $stmt->execute();

    // if ($stmt->affected_rows > 0) {
    //   echo 'add player to stats table successfully';
    // } else {
    //   echo 'an error has occurred';
    // }
    $db->close();

    header("location: manager_page.php");
    exit;

  }
  $db->close();



 ?>
