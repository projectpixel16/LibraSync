<?php
    include ('include/dbcon.php');
    $sql = "SELECT COUNT(borrow_book.user_id) AS borrow_count, school_name FROM borrow_book INNER JOIN user ON borrow_book.user_id=user.user_id WHERE borrow_book.status='1' GROUP BY school_name ORDER BY school_name ASC";
    $result = $con->query($sql);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
?>