<?php
session_start();

$id=$_SESSION['id'];
echo $id;

require_once 'config.php';
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$nlastname= trim( preg_replace("/\t|\R/",' ',$_POST['lastname']) );
$nfirstname= trim( preg_replace("/\t|\R/",' ',$_POST['firstname']) );
$nstreet =  trim( preg_replace("/\t|\R/",' ',$_POST['street']) );
$ncity= trim( preg_replace("/\t|\R/",' ',$_POST['city']) );
$nstate= trim( preg_replace("/\t|\R/",' ',$_POST['state']) );
$ncountry=trim( preg_replace("/\t|\R/",' ',$_POST['country']) );
$nzip=trim( preg_replace("/\t|\R/",' ',$_POST['zip']) );

        $sql= " UPDATE PROFILE
             SET
             PROFILE.FIRST_NAME=?,
             PROFILE.LAST_NAME =?,
             PROFILE.STREET =?,
             PROFILE.CITY =?,
             PROFILE.STATE =?,
             PROFILE.COUNTRY =?,
             PROFILE.ZIPCODE =?
             WHERE PROFILE.PROFILE_ID='$id'
              ";

         $stmt=$link->prepare($sql);
         $stmt->bind_param('ssssssd',
         $nfirstname,
         $nlastname,
         $nstreet ,
         $ncity,
         $nstate,
         $ncountry,
         $nzip);

           if($stmt->execute()){
             //header('location:update_Profile_true.php');
             //exit;
           }
           else{
               echo "Something went wrong. Please try again later.";
               }

         $link->close();

?>
