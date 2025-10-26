<?php

include("connection.php");
$id = $_GET['id'];
$query = "DELETE from users where id = '$id'";
$data = mysqli_query($conn,$query);
if($data)
{
    echo "RECORD DELETED";
     ?>
          <meta http-equiv="refresh" content="0; url=http://localhost/Star%20Public%20School/display.php">
          <?php
}
else{
    echo "RECORD NOT DELETED";
}
?>