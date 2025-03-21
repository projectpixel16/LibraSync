<?php 
    if($_POST['type']==='Community Member'){
        $min = 10000000000;
        $max = 99999999999;
        $generate_idnumber=mt_rand($min,$max);
        echo $generate_idnumber;
    }
?>