<?php
    include('session.php');
    include('../include/dbcon.php');
    $id = $_GET['id'];
    mysqli_query($con,"UPDATE notifications SET status='read' WHERE id='$id' AND user_id = '$id_session'") or die (mysqli_error());
?>
