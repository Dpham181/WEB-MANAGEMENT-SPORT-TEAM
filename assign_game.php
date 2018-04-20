<?php


require_once 'config.php';
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$team1 ="";
$team2 = "";
$gameid = "";
$SCORE = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST"){

  if (empty($team1)){
  $team1 = trim(preg_replace("/\t|\R/",' ',$_POST['TEAM1']));
}
  if (empty($team2)){
  $team2 = trim(preg_replace("/\t|\R/",' ',$_POST['TEAM2']) );
}
if (empty($gameid)){
$gameid = trim(preg_replace("/\t|\R/",' ',$_POST['GAMEID']) );
}
  $sql = "INSERT INTO PLAY
            SET
            PLAY.PGAME_ID=?,
            PLAY.PTEAM_ID=?,
            PLAY.SCORE=?
              ";

  $stmt=$link->prepare($sql);
  $stmt->bind_param('iii',$gameid,$team1,$SCORE);
  $stmt->execute();
  $gameid = $gameid;
  $team1= $team2;
  $SCORE = null;
  $stmt->execute();

   $stmt->close();
}




?>
