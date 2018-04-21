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




if (!empty($_POST['startday'])){
$sd= $_POST['startday'];
}
if (!empty($_POST['endday'])){
$ed= $_POST['endday'];
}
 $sql1="INSERT INTO GAMES
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


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"].'#form-create-game'); ?>" method="post">

      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Start Day</div>
        </div>
        <input type="date" name="startday" class="form-control" value="" placeholder="mm/dd/yyyy" required>
      </div>


      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">End Day</div>
        </div>
        <input type="date" name="endday" class="form-control" value="" placeholder="mm/dd/yyyy" required>
      </div>


      <div class="form-check">
        <input id="submit" type="submit" class="btn btn-primary" value="Create">
        <input type="reset" class="btn btn-default" value="Reset">
      </div>
    </form>
  </body>
</html>
