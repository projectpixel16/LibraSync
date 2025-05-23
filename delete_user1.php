<?php 

include('include/dbcon.php');

$get_id=$_GET['user_id'];

// mysqli_query($con,"delete from user where user_id = '$get_id' ")or die(mysqli_error());
mysqli_query($con," UPDATE user SET archive='0' WHERE user_id = '$get_id' ")or die(mysqli_error());

header('location:user_archive.php');
?>