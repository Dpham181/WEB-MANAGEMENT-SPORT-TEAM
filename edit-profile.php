<?php
  require "header.php";
  require 'Address.php';

  // session_start();
     if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
         header("location: welcome.php");
         exit;
     }
     if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
         header("location: welcome.php");
         exit;
     }
     $user_id = $_SESSION['id'];
     require_once 'config.php';
     $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

     // Check connection
     if ($link === false) {
         die("ERROR: Could not connect. " . mysqli_connect_error());
     }


     $_SESSION['Ln'] = $lastname;
        $_SESSION['Fn'] = $firstname;
        $_SESSION['SE'] = $street;
        $_SESSION['CU'] = $country;
        $_SESSION['CI'] = $city;
        $_SESSION['SA'] = $state;
        $_SESSION['Z']  = $zip;

?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>EDIT PROFILE</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine:bold,bolditalic|Inconsolata:italic|Droid+Sans|Oxygen|Passion+One|Alfa+Slab+One|Monoton|Ubuntu">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rancho|Orbitron&effect=shadow-multiple|3d-float|fire-animation|neon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <link rel="stylesheet" href="css/editProfile.css">
  </head>


  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#top">TEAM MANAGEMENT</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <!-- <li class="nav-item active">
              <a class="nav-link" href="welcome.php">Welcome <span class="sr-only">(current)</span></a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="home.php">Home</a>
            </li>
          <li class="nav-item">
            <a class="nav-link" href="rules.php">Rule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <?php echo $_SESSION['email']; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="check_profileEmpty.php">Profile</a>
              <a class="dropdown-item" href="edit_infor_byuser.php">Edit Profile</a>
              <a class="dropdown-item" href="logout.php">Sign out</a>
            </div>
          </li>
        </ul>

      </div>
    </nav>

    <section>
      <h1 class="font-effect-neon">PROFILE PAGE</h1>
      <h2>
    <?php

    while($stmt->fetch()){


      $user = new Address([$firstname, $lastname], $street, $city, $state, $country, $zip);


      echo "<br>\n";
      echo " <br>".'Your Name:  '. $user->name()."</br>\n";
      echo "<br>\n";
      echo " <br>".'Street: '.$user->street()."</br>\n";
      echo "<br>\n";
      echo " <br>".'State:  '.$user->state()."</br>\n";
      echo "<br>\n";
      echo " <br>".'Country: '.$user->country()."</br>\n";
      echo "<br>\n";
      echo " <br>".'Zipcode: '.$user->zip()."</br>\n";
      echo "<br>\n";








  }

    $stmt->close();

  ?>
</h2>
    </section>
    <!-- <section>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <select name="choice" value="<?php echo $choice; ?>">
            <option value="E">EDIT YOUR INFORMATION </option>
            <option value="V">VIEWING PLAYER STATS</option>
            <option value="" selected>Your choice here</option>
          </select>
        <input type="submit" class="btn btn-primary" value="GO">
        <input type="reset" class="btn btn-default" value="Reset">

  </from>
      <?php

//       if($_SERVER["REQUEST_METHOD"] == "POST"){
//
//         if(empty(trim($_POST["choice"]))){
//             $choice_err = 'You need to select one !!!';
//         } else{
//             $choice = trim( preg_replace("/\t|\R/",' ',$_POST['choice']) );
//         }
//
//
//
//
//       if($choice == 'E'){
//         session_start();
//         $_SESSION['Ln'] = $lastname;
//         $_SESSION['Fn'] = $firstname;
//         $_SESSION['SE'] = $street;
//         $_SESSION['CU'] = $country;
//         $_SESSION['CI'] = $city;
//         $_SESSION['SA'] = $state;
//         $_SESSION['Z']  = $zip;
//
//         header("location: edit_infor_byuser.php");
//         exit;
//
//       }
//       else if ($choice == 'V'){
//         echo " viewing something from table player and stats ";
//       }
// }
       ?>
    </section> -->




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
  <?php
  require "footer.php";
  ?>
