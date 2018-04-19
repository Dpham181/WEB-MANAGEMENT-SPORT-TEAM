<?php


require_once 'config.php';
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$firstname ="";
$lastname = "";
$teamid = "";

// $sql1="SELECT MANAGER.MANAGER_ID FROM MANAGER WHERE MANAGER.MUSER_ID=?";
$sql1= "SELECT TEAM_ID FROM TEAMS WHERE TMANAGER_ID = (SELECT MANAGER_ID FROM MANAGER WHERE MUSER_ID = ?);"
$stmt1=$link->prepare($sql1);
$stmt1->bind_param('i',$user_id);
$stmt1->execute();
$stmt1->store_result();
$stmt1->bind_result($teamid);
$stmt1->fetch();
$teamid;
if($_SERVER["REQUEST_METHOD"] == "POST"){

  if (empty($firstname)){
  $firstname = trim(preg_replace("/\t|\R/",' ',$_POST['firstname']));
}
  if (empty($lastname)){
  $lastname = trim(preg_replace("/\t|\R/",' ',$_POST['lastname']) );
}
  $td = $teamid ;
  $sql = "INSERT INTO PLAYER
            SET
            PLAYER.FIRST_NAME=?,
            PLAYER.LAST_NAME=?,
            PLAYER.PLTEAM_ID=?
              ";

  $stmt=$link->prepare($sql);
  $stmt->bind_param('ssi',$firstname,$lastname,$td);
  $stmt->execute();
   $stmt->close();
}
$stmt1->close();

?>
