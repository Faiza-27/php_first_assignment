<?php
    $range=range(0,9);
    $randnum1=array_rand($range);
    $randnum2=array_rand($range);
    $pat=$randnum1." + ".$randnum2."= ?";
    $capsum=$randnum1+$randnum2;
?>
