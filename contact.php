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
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="FOR WEBSITE CSUF BASKETBALL TEAM">
  <meta name="keywords" content="web design">
  <meta name="author" content="TEAM CPSC431">
  <title>Contact Info</title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">MENU</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="regular_page.php">Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view_games.php">Games</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view_standings.php">Standings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user_view_stats.php">Stats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view_teams.php">Teams</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rules.php">Rules</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Contact</a>
        </li>

        <li id="info"class="nav-item active">
        <a class="nav-link"    <b><?php
          echo "Hi . " .$_SESSION['email'];
           ?></b>.

        </a>
        </li>

        <li id="Profile"class="nav-item active">
          <a class="nav-link" href="update_profile.php">PROFILE</a>

        </li>
        <li id="logout"class="nav-item active">
          <a class="nav-link" href="logout.php">SIGN OUT</a>
        </li>
      </ul>
    </div>
  </nav>


  		<section>

        <div class="container">

          <div class="row align-items-center">
            <div class="col">

    					<h1>
  						Contact league admin for more information <br>
              Phone: (714)123-4567 <br>
              Email: contact@email.com

  						</h1>

            </div>
          </div>

        </div>
      </section>






  		  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZ"></script>



      </body>

  <footer>
      <link rel="stylesheet" href="css/footer.css">
        <p>&copy; CPSC431 SPORTS TEAM WEBSITE DESINGING.<br />
    </footer>




  </html>
