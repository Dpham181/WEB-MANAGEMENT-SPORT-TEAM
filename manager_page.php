<?php
     session_start();
     if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
         header("location: welcome.php");
         exit;
     }
     if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
         header("location: welcome.php");
         exit;
     }
     $choice = $choice_err= "";
     require_once 'config.php';
     $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

     // Check connection
     if ($link === false) {
         die("ERROR: Could not connect. " . mysqli_connect_error());
     }
     if ($_SERVER["REQUEST_METHOD"] == "POST") {

       // checking username if valid or not

         if (empty(trim($_POST["choice"]))) {
             $choice_err = 'You need to select one !!!';
         } else {
             $choice = trim(preg_replace("/\t|\R/", ' ', $_POST['choice']));
         }
     }

?>

  <head>
    <meta charset="utf-8">
    <title>Manager Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine:bold,bolditalic|Inconsolata:italic|Droid+Sans|Oxygen|Passion+One|Alfa+Slab+One|Monoton|Ubuntu">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple|3d-float|fire-animation">
    <link rel="stylesheet" href="css/manager.css">
  </head>
  <?php require "header.php"; ?>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="welcome.php">TEAM MANAGEMENT</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="welcome.php">Welcome <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="rule.html">Rule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact</a>
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

    <section>
      <div>
        <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]); ?>" method="post">
          <select name="choice" value="<?php echo $choice; ?>">
              <option value="E">edit </option>
              <option value="P">Player</option>
              <option value="" selected>Your choice here</option>
            </select>
          <input type="submit" class="btn btn-primary" value="GO">
          <input type="reset" class="btn btn-default" value="Reset">

          </from>
          <?php require_once 'schedule_game.php'; ?>
      </div>

    </section>

    <section>
      <!-- <?php

    if ($choice == 'E') {
        require_once('editPlayerbymanager.php');
    } elseif ($choice == 'P') {
        echo " adding player sql ";
    }
    ?> -->
    </section>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

  <?php
  require "footer.php";
  ?>
