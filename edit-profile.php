<?php
  require"header.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>EDIT PROFILE</title>
  </head>
  <h1 >HERE IS YOUR INFORMATION</h1>

  <body>

    <table style="border:1px solid black; border-collapse:collapse;">
      <tr>
        <th colspan="6" ></th>
      </tr>
      <tr>

        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">FIRST_NAME</th>
          <th style="vertical-align:top; border:1px solid black; background: lightgreen;">LAST_NAME</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">STREET</th>

        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">STATE</th>
          <th style="vertical-align:top; border:1px solid black; background: lightgreen;">COUNTRY  </th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">ZIPCODE</th>


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
  </body>

  <?php
  require "footer.php";
  ?>
