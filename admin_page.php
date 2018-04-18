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
