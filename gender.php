<?php
    $email= $_SESSION['sid'];
    $fo=fopen("users/$email/details.txt","r");
    $i=1;
    while($i!=6){
        $gen=fgets($fo);
        $i++;
    }
    echo "<h2>Your registered gender is ".$gen."</h2>";
?>