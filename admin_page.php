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
    <link rel="stylesheet" href="css/admin.css">
  </head>

  <body>
    <nav id="navbar-manager" class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="admin_page.php">TEAM MANAGEMENT</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto my-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#schedule-games">Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#promote-user">Promote</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#create-assign">Create Game</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="#assign-team">Assign Team</a>
          </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <?php echo $_SESSION['email']; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="check_profileEmpty.php">Profile</a>
              <a class="dropdown-item" href="logout.php">Sign out</a>
              <a class="dropdown-item" href="contact.html">Contact Us</a>
            </div>
          </li>
        </ul>

      </div>
    </nav>

    <div data-spy="scroll" data-target="#navbar-manager" data-offset="0">
      <h1 id="promote-user">PROMOTE</h1>
        <div class="container">
          <table class="table table-bordered table-hover">
            <thead class="thead-dark">
              <tr class="info">
                <th scope="col">TITLE</th>
                <th scope="col">SENDER NAME</th>
                <th scope="col">DATE SENT</th>
                <th scope="col">MESSAGE</th>

              </tr>
            </thead>
            <?php //require_once ('admin_mailboxs.php') ?>

          </table>

          <form action="promote_update.php" method="post">

            <div><select name="user_id" required>
        <option value="" selected disabled hidden>Choose user's acount order by email</option>
        <?php

          $stmt->data_seek(0);
          while( $stmt->fetch() )
          {
            echo "<option value=\"$user_id\">".$email."</option>\n";
          }

          $stmt->free_result();
          $link->close();
          // header("location: admin_page.php");
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
        <a name="form-create-game"></a>



        <?php require 'create_game.php'; ?>
        <h1 id="create-assign"> CREATING GAME </h1>
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
                <input type="submit" class="btn btn-primary" value="Create">
                <input type="reset" class="btn btn-default" value="Reset">
              </div>
            </form>

          <a name="form-assigning-game"></a>
          <h1 id="assign-team">GAMES AVALIBALE FOR ASSIGNING </h1>
        <div class="container">
          <?php require_once ('assign_game.php'); ?>
        </div>
        </div>

        <h1 id="schedule-games">SCHEDULE ALL GAMES</h1>
        <div class="container">
          <?php require_once ('schedule_game.php'); ?>
        </div>



    </div>







    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

  <?php
  require "footer.php";
  ?>
