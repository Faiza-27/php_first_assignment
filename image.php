<?php
    $email= $_SESSION['sid'];
    $fo=fopen("users/$email/details.txt","r");
    $i=1;
    while($i!=8){
        $im=fgets($fo);
        $i++;
    }
    echo "<img src='./users/$email/$im' width='100%' height='100%'>";
?>