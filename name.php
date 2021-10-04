<?php
    $email= $_SESSION['sid'];
    $fo=fopen("users/$email/details.txt","r");
    $name=fgets($fo);
   
    echo "<h2>Your registered name is ".$name."</h2>";
?>
