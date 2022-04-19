<?php

include "includes/config.php";
if(isset($_POST['checkbox']))
{
    $checkbox     = $_POST['checkbox'];
    $updateQuery  = mysqli_query($con, "UPDATE manage_deal set status=$checkbox where id=1");
    if($updateQuery == true) {
        echo "Success";
    } else {
        echo "Error";
    }
}





