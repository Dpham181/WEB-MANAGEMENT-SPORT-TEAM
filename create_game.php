<?php


require_once 'config.php';
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$sd = "";
$ed = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){




if (empty($sd)){
$sd= $_POST['startday'];
}
if (empty($ed)){
$ed= $_POST['endday'];
}
 $sql1= "INSERT INTO GAMES
          SET
          GAMES.START_DAY =?,
          GAMES.END_DAY=?

  ";

  $stmt1=$link->prepare($sql1);
  $stmt1->bind_param('ss',
  $sd,
  $ed

);
 $stmt1->execute();



}
$link->close();

//header("location: admin_page.php#form-create-game");
//exit;
?>
