<?php
  require"header.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>EDIT PROFILE</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="./css/edit_profile.css">
  </head>


  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">TEAM MANAGEMENT</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="welcome.php">Welcome <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="rule.html">Rule</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Dropdown link
          </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    <p>HERE IS YOUR INFORMATION </h1>
    <table style="border:1px solid black; border-collapse:collapse;">
      <tr>
        <th rowspan="6" ></th>
      </tr>
      <tr>

        <th style="vertical-align:top; border:1px solid black; background: #e8491d;">FIRST_NAME</th>
        <th style="vertical-align:top; border:1px solid black; background: #e8491d;">LAST_NAME</th>
        <th style="vertical-align:top; border:1px solid black; background: #e8491d;">STREET</th>

        <th style="vertical-align:top; border:1px solid black; background: #e8491d;">STATE</th>
        <th style="vertical-align:top; border:1px solid black; background: #e8491d;">COUNTRY  </th>
        <th style="vertical-align:top; border:1px solid black; background: #e8491d;">ZIPCODE</th>


      </tr>
    <?php
    while($stmt->fetch()){



    echo "<tr>\n";

    echo "<td style='vertical-align:top; border:1px solid black;'> ". $firstname ."</td>\n";
    echo "<td style='vertical-align:top; border:1px solid black;'>". $lastname ."</td>\n";
    echo "<td  style='vertical-align:top; border:1px solid black;'>". $city ."</td>\n";
    echo "<td style='vertical-align:top; border:1px solid black;'> ". $state ."</td>\n";
    echo "<td style='vertical-align:top; border:1px solid black;'>". $country ."</td>\n";
    echo "<td style='vertical-align:top; border:1px solid black;'>". $zip ."</td>\n";
    echo "</tr>";


  }

    $stmt->close();

  ?>
    </table>
  </section>
    <section>
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
      $choice="";
      if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST["choice"]))){
            $choice_err = 'You need to select one !!!';
        } else{
            $choice = trim( preg_replace("/\t|\R/",' ',$_POST['choice']) );
        }


   }

      if($choice == 'E'){
          $sql= " UPDATE  PROFILE SET
          PROFILE.PROFILE_ID  = ?,
          PROFILE.PUSER_ID  = ?,
          PROFILE.FIRST_NAME=?,
          PROFILE.LAST_NAME =?,
          PROFILE.STREET =?,
          PROFILE.CITY =?,
          PROFILE.STATE =?,
          PROFILE.COUNTRY =?,
          PROFILE.ZIPCODE =?
          WHERE PROFILE.FIRST_NAME='$USER_ID'
           ";

      $stmt=$link->prepare($sql);



      }
      else if ($choice == 'V'){
        echo " viewing something from table player and stats ";
      }

       ?>
    </section>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
  <?php
  require "footer.php";
  ?>
