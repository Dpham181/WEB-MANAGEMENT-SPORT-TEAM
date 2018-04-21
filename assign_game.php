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

$SCORE = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST"){


if(!empty($_POST['TEAMID']))
  {
  $twoteams= $_POST['TEAMID'];
  $team1= $twoteams[0];
  $team2=  $twoteams[1];
  }

if (!empty($_POST['GAMEID'])){
$gameid = $_POST['GAMEID'];
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
  $SCORE = $SCORE;
  $stmt->execute();

   $stmt->close();

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
    <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"].'#form-assigning-game'); ?>" method="post">

      <table class="table table-bordered table-hover">
        <thead class="thead-dark">
          <tr class="info">
            <th scope="col">GAME ID</th>
            <th scope="col">START DAY</th>
            <th scope="col">END DAY</th>
            <th scope="col">CHECK BOX</th>

          </tr>
        </thead>
        <?php require('viewGamesbyADMIN.php');?>
        </table>


      <h1>TEAMS AVALIBALE FOR ASSIGNING </h1>

      <table class="table table-bordered table-hover">
     <thead class="thead-dark">
       <tr class="info">
         <th scope="col">TEAM ID</th>
         <th scope="col">TEAM NAME</th>
         <th scope="col">MANAGER ID</th>
         <th scope="col">CHECK BOX</th>

       </tr>
     </thead>
      <?php
         require_once('view_teams.php');
         ?>

   </table>

   <div class="form-check">
     <input type="submit" class="btn btn-primary" value="Assign">
     <input type="reset" class="btn btn-default" value="Reset">
   </div>

  </form>

  </body>
</html>
