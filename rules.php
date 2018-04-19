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
  <title>Regular User Page</title>
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
          <a class="nav-link" href="regular_page.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Games</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Standings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Stats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Teams</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Rules</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.html">Contact</a>
        </li>

        <li id="info"class="nav-item active">
        <a class="nav-link"    <b><?php
          echo "Hi . " .$_SESSION['email'];
           ?></b>. Welcome

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

  <section id="body">
      <div class="container">
        <!DOCTYPE html>
        <html>

        <head>
        	<meta charset="utf-8">
        	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        	<meta name="description" content="FOR WEBSITE CSUF BASKETBALL TEAM">
        	<meta name="keywords" content="web design">
        	<meta name="author" content="TEAM CPSC431">
        	<title>RULES</title>
        	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
          	<link rel="stylesheet" href="css/welcome.css">
        </head>

        	<header>
        		<div id="top">
        			<img src="./logo/1.jpg" alt="CSUF LOGO" height=100% width=100%/>
        			<h1> THE RULES </h1>
        		</div>
        	</header>

            <body>

          					<h1>
        							The Rules
        Basketball is a team sport. Two teams of five players each try to score by shooting a ball through a hoop elevated 10 feet above the ground. The game is played on a rectangular floor called the court, and there is a hoop at each end. The court is divided into two main sections by the mid-court line. If the offensive team puts the ball into play behind the mid-court line, it has ten seconds to get the ball over the mid-court line. If it doesn't, then the defense gets the ball. Once the offensive team gets the ball over the mid-court line, it can no longer have possession of the ball in the area in back of the line. If it does, the defense is awarded the ball.

        court (4K)
        Basketball Court 1


        The ball is moved down the court toward the basket by passing or dribbling. The team with the ball is called the offense. The team without the ball is called the defense. They try to steal the ball, contest shots, steal and deflect passes, and garner rebounds.

        When a team makes a basket, they score two points and the ball goes to the other team. If a basket, or field goal, is made outside of the three-point arc, then that basket is worth three points. A free throw is worth one point. Free throws are awarded to a team according to some formats involving the number of fouls committed in a half and/or the type of foul committed. Fouling a shooter always results in two or three free throws being awarded the shooter, depending upon where he was when he shot. If he was beyond the three-point line, then he gets three shots. Other types of fouls do not result in free throws being awarded until a certain number have accumulated during a half. Once that number is reached, then the player who was fouled is awarded a '1-and-1' opportunity. If he makes his first free throw, he gets to attempt a second. If he misses the first shot, the ball is live on the rebound.

        Each game is divided into sections. All levels have two halves. In college, each half is twenty minutes long. In high school and below, the halves are divided into eight (and sometimes, six) minute quarters. In the pros, quarters are twelve minutes long. There is a gap of several minutes between halves. Gaps between quarters are relatively short. If the score is tied at the end of regulation, then overtime periods of various lengths are played until a winner emerges.

        Each team is assigned a basket or goal to defend. This means that the other basket is their scoring basket. At halftime, the teams switch goals. The game begins with one player from either team at center court. A referee will toss the ball up between the two. The player that gets his hands on the ball will tip it to a teammate. This is called a tip-off. In addition to stealing the ball from an opposing player, there are other ways for a team to get the ball.

        One such way is if the other team commits a foul or violation.


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

      </div>
  </section>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
