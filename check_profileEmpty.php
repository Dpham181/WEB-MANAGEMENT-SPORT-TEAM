
<?php
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


     $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

     // Check connection
     if($link === false){
         die("ERROR: Could not connect. " . mysqli_connect_error());
     }
     // Define variables and initialize with empty values

      $ID=$_SESSION['id'];
             $sql = "SELECT
                       PROFILE.FIRST_NAME,
                       PROFILE.LAST_NAME,
                       PROFILE.STREET,
                       PROFILE.CITY,
                       PROFILE.STATE,
                       PROFILE.COUNTRY,
                       PROFILE.ZIPCODE
                      FROM PROFILE
                      WHERE PROFILE.PUSER_ID=?
                       ";

                  $stmt=$link->prepare($sql);
                       $stmt->bind_param("s", $ID_USER);
                       $ID_USER = $ID;

                      if ($stmt->execute()){

                        $stmt->store_result();
                        $stmt->bind_result(
                  $firstname,
                  $lastname,
                  $street ,
                  $city,
                  $state,
                  $country,
                  $zip);

                  if ($stmt->num_rows == 1)
                  {
                    require_once "edit-profile.php";

                  }
                  else{

                    require_once "update-profile.php";


                      }

                }








         // Close connection
         $link->close();

?>
