<?php
    $email= $_SESSION['sid'];
    $fo=fopen("users/$email/details.txt","r");
    $i=1;
    while($i!=7){
        $age=fgets($fo);
        $i++;
    }
    echo "<h2>Your age is: $age </h2>" ;
?>