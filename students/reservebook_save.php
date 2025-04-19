<?php 
    include('../include/dbcon.php');
	$user_id =$_POST['user_id'];
	$book_id =$_POST['book_id'];
	$date_borrowed =$_POST['date_borrowed'];
	$due_date =$_POST['due_date'];
	$pickdate =$_POST['pickdate'];
	$school_number =$_POST['school_number'];

	$trapBookCount= mysqli_query($con,"SELECT count(*) as books_allowed from borrow_book where user_id = '$user_id' and borrowed_status = 'borrowed'") or die (mysqli_error());

	$countBorrowed = mysqli_fetch_assoc($trapBookCount);

	$bookCountQuery= mysqli_query($con,"SELECT count(*) as book_count from borrow_book where user_id = '$user_id' and borrowed_status = 'borrowed' and book_id = $book_id") or die (mysqli_error());

	$bookCount = mysqli_fetch_assoc($bookCountQuery);

	$allowed_book_query= mysqli_query($con,"select * from allowed_book order by allowed_book_id DESC ") or die (mysqli_error());
	$allowed = mysqli_fetch_assoc($allowed_book_query);

	if ($countBorrowed['books_allowed'] == $allowed['qntty_books']){
		echo "<script>alert(' ".$allowed['qntty_books']." ".'Books Allowed per User!'." '); window.location='reserve_book.php?school_number=".$school_number."'</script>";
	}elseif ($bookCount['book_count'] == 1){
		echo "<script>alert('Book Already Borrowed!'); window.location='reserve_book.php?school_number=".$school_number."'</script>";
	}else{
		
		$update_copies = mysqli_query($con,"SELECT * from book where book_id = '$book_id' ") or die (mysqli_error());
		$copies_row= mysqli_fetch_assoc($update_copies);
		
		$book_copies = $copies_row['book_copies'];
		$new_book_copies = $book_copies - 1;
		
		if ($new_book_copies < 0){
			echo "<script>alert('Book out of Copy!'); window.location='reserve_book.php?school_number=".$school_number."'</script>";
		}elseif ($copies_row['status'] == 'Damaged'){
			echo "<script>alert('Book Cannot Borrow At This Moment!'); window.location='reserve_book.php?school_number=".$school_number."'</script>";
		}elseif ($copies_row['status'] == 'Lost'){
			echo "<script>alert('Book Cannot Borrow At This Moment!'); window.location='reserve_book.php?school_number=".$school_number."'</script>";
		}else{
			
			// if ($new_book_copies == '0') {
			// 	$remark = 'Not Available';
			// } else {
			// 	$remark = 'Available';
			// }
			
			// mysqli_query($con,"UPDATE book SET book_copies = '$new_book_copies' where book_id = '$book_id' ") or die (mysqli_error());
			// mysqli_query($con,"UPDATE book SET remarks = '$remark' where book_id = '$book_id' ") or die (mysqli_error());
			
			// mysqli_query($con,"INSERT INTO borrow_book(user_id,book_id,date_borrowed,pickup_date,borrowed_status)
			// VALUES('$user_id','$book_id','$date_borrowed','$pickdate','reserve')") or die (mysqli_error());
			$query = "INSERT INTO borrow_book(user_id, book_id, date_borrowed, pickup_date, borrowed_status) 
					VALUES ('$user_id', '$book_id', '$date_borrowed', '$pickdate', 'reserve')";

			if (mysqli_query($con, $query)) {
				$last_id = mysqli_insert_id($con); // Get the last inserted ID
				echo $last_id;
			} else {
				die("Error: " . mysqli_error($con));
			}
			
			// $report_history=mysqli_query($con,"select * from user where user_id = $id_session ") or die (mysqli_error());
			// $report_history_row=mysqli_fetch_array($report_history);
			// $admin_row=$report_history_row['firstname']." ".$report_history_row['middlename']." ".$report_history_row['lastname'];	
			
			// mysqli_query($con,"INSERT INTO report 
			// (book_id, user_id, admin_name, detail_action, date_transaction)
			// VALUES ('$book_id','$user_id','$admin_row','Borrowed Book',NOW())") or die(mysqli_error());

		}
	}
?>