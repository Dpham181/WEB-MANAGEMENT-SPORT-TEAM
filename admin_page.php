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
?>

     <head>
       <meta charset="utf-8">
       <title>Admin Page</title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
       <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine:bold,bolditalic|Inconsolata:italic|Droid+Sans|Oxygen|Passion+One|Alfa+Slab+One|Monoton|Ubuntu">
       <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple|3d-float|fire-animation">
       <link rel="stylesheet" href="css/manager.css">
     </head>

     <body>
       <nav id="navbar-manager" class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
         <a class="navbar-brand" href="admin_page.php">Admin Page</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
     </button>
         <div class="collapse navbar-collapse" id="navbarNavDropdown">
           <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
             <li class="nav-item active">
               <a class="nav-link" href="admin.php">Home<span class="sr-only">(current)</span></a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#manage-games">Manage Games</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#edit-player">Edit Players</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#create-team">Create Team</a>
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
       <div data-spy="scroll" data-target="#navbar-manager" data-offset="0">
         <h4 id="manage-games">Create Games</h4>
         <p>...</p>
         <?php require 'schedule_game.php'; ?>
         <h4 id="edit-player">ADD PLAYER</h4>
         <p>...</p>
         <?php require 'addingplayer.php'; ?>

         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

           <div>
               <label>First Name:<sup>*</sup></label>
             <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>" placeholder="Player's first name" autofocus required>
           </div>
           <div>
             <label>Last Name:<sup>*</sup></label>
             <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>" placeholder="Player's last name" required>
           </div>

           <div>
             <input id="submit" type="submit" class="btn btn-primary" value="Submit">
             <input type="reset" class="btn btn-default" value="Reset">
           </div>
         </form>
   =      <h4 id="view-player">Viewing Player</h4>
         <p>...</p>
         <?php require 'vrplayer_bymanager.php'; ?>

       </div>



             <!-- <?php require_once 'schedule_game.php'; ?> -->

   </div>


       </section>
       <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     </body>
      // $sql = "SELECT PROFILE.PROFILE_ID,
      //                PROFILE.FIRST_NAME,
      //                PROFILE.LAST_NAME ,
      //                PROFILE.STREET ,
      //                PROFILE.CITY,
      //                PROFILE.STATE ,
      //                PROFILE.COUNTRY,
      //                PROFILE.ZIPCODE
      //        FROM PROFILE
      //
      //
      //             GROUP BY
      //               PROFILE.LAST_NAME,
      //               PROFILE.FIRST_NAME
      //             ORDER BY
      //               PROFILE.LAST_NAME,
      //               PROFILE.FIRST_NAME";


      // $stmt = $link->prepare($sql);
      // $stmt->execute();
      // $stmt->store_result();
      // $stmt->bind_result($Name_ID,
      //                    $Name_First,
      //                    $Name_Last,
      //                    $Street,
      //                    $City,
      //                    $State,
      //                    $Country,
      //                    $ZipCode);

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

  <body>
    <h1>Hi, ADMIN<b><?php
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
  </body>
  </body>

  <?php
  require "footer.php";
  ?>
