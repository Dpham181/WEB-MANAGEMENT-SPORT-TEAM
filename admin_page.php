<?php

     session_start();
     if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
       header("location: welcome.php");
       exit;
     }
     if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
       header("location: welcome.php");
       exit;
     }
     require_once 'config.php';
     require_once 'Address.php';
     $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

     // Check connection
     if($link === false){
         die("ERROR: Could not connect. " . mysqli_connect_error());
     }
     $type = $type_err ="";

      $sql = "
      SELECT USER_ID, EMAIL
      FROM USERS
      GROUP BY EMAIL
      ORDER BY EMAIL
      ";
      $stmt = $link->prepare($sql);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result(
        $user_id,
        $email
      );



?>

  <head>
    <meta charset="utf-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine:bold,bolditalic|Inconsolata:italic|Droid+Sans|Oxygen|Passion+One|Alfa+Slab+One|Monoton|Ubuntu">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple|3d-float|fire-animation|fire|neon">
  </head>

  <body>
    <?php require 'header.php'; ?>


    <b><?php
    echo $_SESSION['email'];
     ?></b>. Welcome
    <a href="logout.php" >Sign Out</a>

    <div class="flex-containers">
      <div style="flex-grow: 1">
        <h1> Promote form </h1>
    <form action="promote_update.php" method="post">

      <!-- <div><select name="name_ID" required> -->
      <div><select name="user_id" required>
                  <option value="" selected disabled hidden>Choose user's acount order by email</option>
                  <?php
                    // $stmt->data_seek(0);
                    // while( $stmt->fetch() )
                    // {
                    //   $player = new Address([$Name_First, $Name_Last]);
                    //   echo "<option value=\"$Name_ID\">".$player->name()."</option>\n";
                    // }
                    $stmt->data_seek(0);
                    while( $stmt->fetch() )
                    {
                      echo "<option value=\"$user_id\">".$email."</option>\n";
                    }
                  ?>

                </select>
        <select name="type">
                            <option value="" selected disabled hidden>Their New Position</option>
                        <option value="M">MANAGER</option>
                        <option value="A">ADMIN</option>
                        <option value="P">PLAYER</option>
                      </select>
        <input type="submit" class="btn btn-primary" value="Promote Now">
        <input type="reset" class="btn btn-default" value="Reset">

      </div>
    </form>

    </div>
    </div>
    <div style="flex-grow: 1">




    </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

  <?php
  require "footer.php";
  ?>
