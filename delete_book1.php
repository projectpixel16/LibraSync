<?php 
    include('include/dbcon.php');

    $get_id=$_GET['book_id'];

    // mysqli_query($con,"delete from user where book_id = '$get_id' ")or die(mysqli_error());
    mysqli_query($con," UPDATE book SET archive='0' WHERE book_id = '$get_id' ")or die(mysqli_error());

    header('location:book_archive.php');
?>