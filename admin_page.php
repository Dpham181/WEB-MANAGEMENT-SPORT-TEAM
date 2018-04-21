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
    <!--
  <nav id="navbar-manager" class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="manager_page.php">TEAM MANAGEMENT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <!-- <li class="nav-item active">
          <a class="nav-link" href="#TOP">TOP<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#promte">Promote Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#create">Creating A Game</a>
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
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
      </ul>

    </div>
  </nav>
  -->
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link" id="nav-contact-tab" href="welcome.php">BACK TO HOME</a>


        <a class="nav-item nav-link" id="nav-promote-tab" data-toggle="tab" href="#nav-promote" role="tab" aria-controls="nav-profile" aria-selected="false">Promote</a>




        <a class="nav-item nav-link" id="nav-create-tab" data-toggle="tab" href="#nav-create" role="tab" aria-controls="nav-profile" aria-selected="false">Makes Game</a>




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
        <h1>Promote Users</h1>
        <form action="promote_update.php" method="post">

          <!-- <div><select name="name_ID" required> -->
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

        <h1>MAKING GAMES</h1>

        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr class="info">
              <th scope="col">TEAM ID</th>
              <th scope="col">TEAM NAME</th>
              <th scope="col">MANAGER ID</th>
              <th scope="col">WIN</th>
              <th scope="col">LOSE</th>
            </tr>
          </thead>
          <?php
              require_once('view_teams.php');
              ?>

        </table>
        <a name="form-create-game"></a>


        <?php require_once('create_game.php');
            echo $_SERVER["PHP_SELF"]; ?>

        <h1> CREATING GAME </h1>

        <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "].'#form-create-game'); ?>" method="post">

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



        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr class="info">
              <th scope="col">GAME ID</th>
              <th scope="col">TEAM ID</th>
              <th scope="col">SCORE</th>

            </tr>
          </thead>
          <?php
                          require('viewGAMES.php');
                          ?>
        </table>
        <a name="form-assigning-game"></a>
        <h1>ASSINING GAMES HERE </h1>

        <?php  require_once('assign_game.php'); ?>
        <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "].'#form-assigning-game'); ?>" method="post">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">GAME ID</div>
            </div>
            <input type="text" name="GAMEID" class="form-control" value="" placeholder="PLACE GAME ID HERE" required>
          </div>

          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">TEAM 1</div>
            </div>
            <input type="text" name="TEAM1" class="form-control" value="" placeholder="First Team ID" required>
          </div>



          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">TEAM 2</div>
            </div>
            <input type="text" name="TEAM2" class="form-control" value="" placeholder="Second Team ID" required>
          </div>

          <div class="form-check">
            <input id="submit" type="submit" class="btn btn-primary" value="Create">
            <input type="reset" class="btn btn-default" value="Reset">
          </div>
        </form>

      </div>




    </div>
    <?php
      require_once('schedule_game.php');
      ?>

      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

  <?php
  require "footer.php";
  ?>
