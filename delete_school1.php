<?php 
    include('include/dbcon.php');

    $get_id=$_GET['school_id'];
    mysqli_query($con," UPDATE schools SET status='Active' WHERE school_id = '$get_id' ")or die(mysqli_error());
    header('location:school_archive.php');
?>