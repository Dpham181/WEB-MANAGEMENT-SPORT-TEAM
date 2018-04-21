<?php
     require "header.php";

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
    <title>Manager Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine:bold,bolditalic|Inconsolata:italic|Droid+Sans|Oxygen|Passion+One|Alfa+Slab+One|Monoton|Ubuntu">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple|3d-float|fire-animation|fire|neon">
    <link rel="stylesheet" href="css/manager.css">
  </head>

  <body>
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link" id="nav-contact-tab" href="welcome.php">BACK TO HOME</a>


        <a class="nav-item nav-link" id="nav-promote-tab" data-toggle="tab" href="#nav-promote" role="tab" aria-controls="nav-profile" aria-selected="false">Promote</a>




        <a class="nav-item nav-link" id="nav-create-tab" data-toggle="tab" href="#nav-create" role="tab" aria-controls="nav-profile" aria-selected="false">Makes Game</a>

        <a class="nav-item nav-link" id="nav-assgin-tab" data-toggle="tab" href="#nav-assign" role="tab" aria-controls="nav-profile" aria-selected="false">Assign Team Game</a>




        <ul class="nav nav-pills">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION['email']; ?>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="check_profileEmpty.php">Profile</a>
              <a class="dropdown-item" href="logout.php">Sign out</a>
              <a class="dropdown-item" href="contact.html">Contact</a>
            </div>
          </li>

        </ul>

      </div>

    </nav>









    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade" id="nav-promote" role="tabpanel" aria-labelledby="nav-promote-tab">
        <h1>HERE IS YOUR MAIL BOX  </h1>
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr class="info">
              <th scope="col">title</th>
              <th scope="col">SENDER NAME</th>
              <th scope="col">DATE SENT</th>
              <th scope="col">FORM</th>

            </tr>
          </thead>
          <?php require_once ('admin_mailboxs.php') ?>

        </table>



        <h1>Promote Users</h1>


        <form action="promote_update.php" method="post">

          <div><select name="user_id" required>
                  <option value="" selected disabled hidden>Choose user's acount order by email</option>
                  <?php

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
                      </select>
            <input type="submit" class="btn btn-primary" value="Promote Now">
            <input type="reset" class="btn btn-default" value="Reset">

          </div>
        </form>
      </div>
      <div class="tab-pane fade" id="nav-create" role="tabpanel" aria-labelledby="nav-create-tab">
        <?php
          require_once ('schedule_game.php');
          ?>


          <h1> CREATING GAME </h1>
          <?php require_once ('create_game.php');?>

      </div>


      <div class="tab-pane fade" id="nav-assign" role="tabpanel" aria-labelledby="nav-assgin-tab">

        <h1>GAMES AVALIBALE FOR ASSIGNING </h1>

        <?php require_once ('assign_game.php'); ?>

      </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

  <?php
  require "footer.php";
  ?>
