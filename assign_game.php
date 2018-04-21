<?php


require_once 'config.php';
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$team1 ="";
$team2 = "";
$gameid= "";
/*
$sd = "";
$ed = "";
*/
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
/*
if (empty($sd)){
$sd= $_POST['startday'];
}
if (empty($ed)){
$ed= $_POST['endday'];
}

*
 $sql1= "INSERT INTO GAMES
          SET
          GAMES.GAME_ID,
          GAMES.START_DAY,
          GAMES.END_DAY

  ";

  $stmt1=$link->prepare($sql1);
  $stmt1->bind_param('iss',
  $gameid,
  $sd,
  $ed

);
 $stmt1->execute();
 $stmt1->close();
*/


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
  $SCORE = $SCORE;
  $stmt->execute();

   $stmt->close();
}



?>
