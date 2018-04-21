<?php
session_start();

// if(!isset($_SESSION['Ln']) || empty($_SESSION['Ln'])){
// header("location: welcome.php");
// exit;
// }

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
         header("location: welcome.php");
         exit;
     }



require_once 'config.php';
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$nlastname="";
$nfirstname="";
$nstreet ="";
$ncity="";
$nstate="";
$ncountry="";
$nzip="";


$lastname=$_SESSION['Ln'];
$firstname=$_SESSION['Fn'];
$street=$_SESSION['SE'];
$state=$_SESSION['SA'];
$country=$_SESSION['CU'];
$zip=$_SESSION['Z'];
$city=$_SESSION['CI'];
if($_SERVER["REQUEST_METHOD"] == "POST"){



       if (empty(trim( preg_replace("/\t|\R/",' ',$_POST['nlastname']) ))){
           $nlastname=$lastname;
       }
       else {
         $nlastname= trim( preg_replace("/\t|\R/",' ',$_POST['nlastname']) );

       }
       if(empty(trim( preg_replace("/\t|\R/",' ',$_POST['nfirstname']) ))){
         $nfirstname=$firstname;
       }
       else
       {
         $nfirstname= trim( preg_replace("/\t|\R/",' ',$_POST['nfirstname']) );

       }
       if(empty(trim( preg_replace("/\t|\R/",' ',$_POST['nstreet']) ))){
         $nstreet=$street;
       }
       else
         {
           $nstreet =  trim( preg_replace("/\t|\R/",' ',$_POST['nstreet']) );
         }
       if(empty(trim( preg_replace("/\t|\R/",' ',$_POST['nstate']) ))){
         $nstate=$state;
       }else {
         $nstate= trim( preg_replace("/\t|\R/",' ',$_POST['nstate']) );

       }
       if(empty(trim( preg_replace("/\t|\R/",' ',$_POST['ncountry']) ))){
            $ncountry=$country;
       }else {
         $ncountry=trim( preg_replace("/\t|\R/",' ',$_POST['ncountry']) );
       }
       if(empty(trim( preg_replace("/\t|\R/",' ',$_POST['nzip']) ))){
         $nzip=$zip;
       }else {
         $nzip=trim( preg_replace("/\t|\R/",' ',$_POST['nzip']) );

       }
       if(empty(trim( preg_replace("/\t|\R/",' ',$_POST['ncity']) ))){
         $ncity=$city;
       }
       else {
         $ncity= trim( preg_replace("/\t|\R/",' ',$_POST['ncity']) );

       }

             $sql= " UPDATE PROFILE
             SET
             PROFILE.FIRST_NAME=?,
             PROFILE.LAST_NAME =?,
             PROFILE.STREET =?,
             PROFILE.CITY =?,
             PROFILE.STATE =?,
             PROFILE.COUNTRY =?,
             PROFILE.ZIPCODE =?
             WHERE PROFILE.LAST_NAME='$lastname'
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
             header('location:welcome.php');
             exit;
           }
           else{
               echo "Something went wrong. Please try again later.";
               }









        }
         $link->close();

?>

  <body>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit by User</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            body{ font: 14px sans-serif; }
            .wrapper{ width: 350px; padding: 20px; background-color:lightblue}
        </style>
    </head>
    <body>

            <h2>Edit your infor here</h2>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

              <div>
                    <label>Your frist Name:<sup>*</sup></label>
                    <input type="text" name="nfirstname"class="form-control" value="<?php echo $nfirstname; ?>">

                </div>
                <div>
                   <label>Your last Name:<sup>*</sup></label>
                   <input type="text" name="nlastname"class="form-control" value="<?php echo $nlastname; ?>">

               </div>
              <div>
                    <label>Street:<sup>*</sup></label>
                    <input type="text" name="nstreet"class="form-control" value="<?php echo $nstreet; ?>">

              </div>
              <div>
                    <label>City:<sup>*</sup></label>
                    <input type="text" name="ncity"class="form-control" value="<?php echo $ncity; ?>">

              </div>
              <div>
                      <label>State:<sup>*</sup></label>
                      <input type="text" name="nstate"class="form-control" value="<?php echo $nstate; ?>">

             </div>

           <div>
                   <label>Country:<sup>*</sup></label>
                   <input type="text" name="ncountry"class="form-control" value="<?php echo $ncountry; ?>">

          </div>
              <div>
                    <label>ZipCode:<sup>*</sup></label>
                    <input type="text" name="nzip"class="form-control" value="<?php echo $nzip; ?>">

              </div>
                <div>
                    <input type="submit" class="btn btn-primary" value="Update">
                    <input type="reset" class="btn btn-default" value="Reset">
                </div>
            </form>
    </body>
    </html>
