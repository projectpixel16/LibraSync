<?php
include('session.php');
include('../include/dbcon.php');
 // Get logged-in borrower ID

// Fetch unread notifications
// $sql = "SELECT * FROM notifications WHERE user_id = '$id_session' AND status = 'unread' ORDER BY created_at DESC";
// $stmt = $con->prepare($sql);
// $stmt->bind_param("i", $id_session);
// $stmt->execute();
// $result = $stmt->get_result();
// $notifications = $result->fetch_all(MYSQLI_ASSOC);
$query = mysqli_query($con, "SELECT * FROM notifications WHERE user_id = '$id_session' AND status = 'unread' ORDER BY created_at DESC") or die(mysqli_error($con));
$notifications = mysqli_fetch_all($query, MYSQLI_ASSOC);

// Mark fetched notifications as read
// $sql = "UPDATE notifications SET status='read' WHERE user_id = '$id_session'";
// $stmt = $con->prepare($sql);
// $stmt->bind_param("i", $id_session);
// $stmt->execute();

// echo $id_session;
echo json_encode($notifications);
?>
