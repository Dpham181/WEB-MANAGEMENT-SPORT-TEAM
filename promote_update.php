<?php


$ID       = (int) $_POST['name_ID'];
$type     = trim( preg_replace("/\t|\R/",' ',$_POST['type']) );



if( ! empty($ID ))
{
  require_once( 'config.php' );
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  // Check connection
  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }



  $sql ="UPDATE USERS

         SET USERS.TYPE = ?

         WHERE

         USERS.USER_ID  = '$ID'
          ";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('s', $type);
  if( $stmt->execute()){
    echo " Already updated thanks now go back to your admin page !!";
    header('admin_page.php');
    exit;
  }


}

?>
