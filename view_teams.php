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
  <title>League Teams</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/regular_page.css">
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
          <a class="nav-link" href="view_games.php">Schedule</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view_standings.php">Standings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view_stats.php">Stats</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="view_teams.php">Teams</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rules.php">Rules</a>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.html">Contact</a>
        </li>

        <li id="info"class="nav-item active">
        <a class="nav-link"    <b><?php
          echo "Hi, " .$_SESSION['email'];
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
    <h1 >League Leaders</h1>

    <?php
      require_once('config.php');
      // Connect to database

      /* Attempt to connect to MySQL database */
      $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

      // Check connection
      if($link === false){
          die("ERROR: Could not connect. " . mysqli_connect_error());
      }

      $query =
    "SELECT

    COUNT(Stats.Player) AS Games_Played,
    AVG(Stats.PlayingTimeMin) AS Avg_Min,
    AVG(Stats.PlayingTimeSec) AS Avg_Sec,
    AVG(Stats.Points) AS Avg_Points,
    AVG(Stats.Assists) AS Avg_Assists,
    AVG(Stats.Rebounds) AS Avg_Rebounds
    FROM Stats
    GROUP BY PLAYER_ID
    ORDER BY PLAYER_ID";

    $stmt = $link->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($Games_Played, $avg_min, $avg_sec, $avg_points, $avg_assists, $avg_rebounds);
  ?>

</html>
