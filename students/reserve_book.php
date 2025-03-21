<?php include ('header.php'); ?>
<?php 
	$school_number = $_GET['school_number'];
	
	$user_query = mysqli_query($con,"SELECT * FROM user WHERE school_number = '$school_number' ");
	$user_row = mysqli_fetch_array($user_query);
?>
        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Home /</small> Reserved Transaction
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
					
					<?php
						$sql = mysqli_query($con,"SELECT * FROM user WHERE school_number = '$school_number' ");
						$row = mysqli_fetch_array($sql);
					?>
					<h2>
					Borrower Name : <span style="color:maroon;"><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></span>
					</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <!-- If needed 
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a></li>
                                    <li><a href="#">Settings 2</a></li>
                                </ul>
                            </li>
						-->
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- content starts here -->
						
						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								
							<thead>
								<tr>
									<th>Barcode</th>
									<th>Title</th>
									<th>Author</th>
									<th>ISBN</th>
									<th>Date Borrowed</th>
									<th>Due Date</th>
									<th>Penalty</th>
									<!-- <th>Action</th> -->
							<?php 
								// $borrow_query = mysqli_query($con,"SELECT * FROM borrow_book
								// 	LEFT JOIN book ON borrow_book.book_id = book.book_id
								// 	WHERE user_id = '".$user_row['user_id']."' && borrowed_status = 'borrowed' ORDER BY borrow_book_id DESC") or die(mysqli_error());
								$borrow_query = mysqli_query($con,"SELECT * FROM borrow_book
									LEFT JOIN book ON borrow_book.book_id = book.book_id
									WHERE user_id = '".$user_row['user_id']."' && borrowed_status = 'borrowed' AND borrow_book.status='1' ORDER BY date_borrowed DESC") or die(mysqli_error());
								$borrow_count = mysqli_num_rows($borrow_query);
								while($borrow_row = mysqli_fetch_array($borrow_query)){
									$due_date= $borrow_row['due_date'];
								
								$timezone = "Asia/Manila";
								if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
								$cur_date = date("Y-m-d H:i:s");
								$date_returned = date("Y-m-d H:i:s");
								//$due_date = strtotime($cur_date);
								//$due_date = strtotime("+3 day", $due_date);
								//$due_date = date('F j, Y g:i a', $due_date);
								///$checkout = date('m/d/Y', strtotime("+1 day", strtotime($due_date)));
								
									$penalty_amount_query= mysqli_query($con,"select * from penalty order by penalty_id DESC ") or die (mysqli_error());
									$penalty_amount = mysqli_fetch_assoc($penalty_amount_query);
									
									if ($date_returned > $due_date) {
										$penalty = round((float)(strtotime($date_returned) - strtotime($due_date)) / (60 * 60 *24) * ($penalty_amount['penalty_amount']));
									} elseif ($date_returned < $due_date) {
										$penalty = 'No Penalty';
									} else {
										$penalty = 'No Penalty';
									}
							?>
								</tr>
							</thead>
							<tbody>
							
							<tr>
								
								<td><?php echo $borrow_row['book_barcode']; ?></td>
								<td style="text-transform: capitalize"><?php echo $borrow_row['book_title']; ?></td>
								<td style="text-transform: capitalize"><?php echo $borrow_row['author']; ?></td>
								<td><?php echo $borrow_row['isbn']; ?></td>
								<td><?php echo date("M d, Y h:m:s a",strtotime($borrow_row['date_borrowed'])); ?></td>
								<?php
									if ($borrow_row['status'] != 'Hardbound') {
										echo "<td>".date('M d, Y h:m:s a',strtotime($borrow_row['due_date']))."</td>";
									} else {
										echo "<td>".'Hardbound Book, Inside Only'."</td>";
									}
								?>
							<!---	<td><?php // echo date("M d, Y h:m:s a",strtotime($borrow_row['due_date'])); ?></td>	-->
								<?php
									if ($borrow_row['status'] != 'Hardbound') {
										echo "<td>".$penalty."</td>";
									} else {
										echo "<td>".'Hardbound Book, Inside Only'."</td>";
									}
								?>
							<!---	<td><?php // echo $penalty; ?></td>	-->
								<!-- <td>
								<form method="post" action="">
								<input type="hidden" name="date_returned" class="new_text" id="sd" value="<?php echo $date_returned ?>" size="16" maxlength="10"  />
								<input type="hidden" name="user_id" value="<?php echo $borrow_row['user_id']; ?>">
								<input type="hidden" name="borrow_book_id" value="<?php echo $borrow_row['borrow_book_id']; ?>">
								<input type="hidden" name="book_id" value="<?php echo $borrow_row['book_id']; ?>">
								<input type="hidden" name="date_borrowed" value="<?php echo $borrow_row['date_borrowed']; ?>">
								<input type="hidden" name="due_date" value="<?php echo $borrow_row['due_date']; ?>">
								<button name="return" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Return</button>
								</form>
								</td> -->
								
							</tr>
							
							<?php 
							}
							if ($borrow_count <= 0){
								echo '
									<table style="float:right;">
										<tr>
											<td style="padding:10px;" class="alert alert-danger">No books borrowed</td>
										</tr>
									</table>
								';
							} 							
							?>
							<?php
								if (isset($_POST['return'])) {
									$user_id= $_POST['user_id'];
									$borrow_book_id= $_POST['borrow_book_id'];
									$book_id= $_POST['book_id'];
									$date_borrowed= $_POST['date_borrowed'];
									$due_date= $_POST['due_date'];
									$date_returned = $_POST['date_returned'];

									$update_copies = mysqli_query($con,"SELECT * from book where book_id = '$book_id' ") or die (mysqli_error());
									$copies_row= mysqli_fetch_assoc($update_copies);
									
									$book_copies = $copies_row['book_copies'];
									$new_book_copies = $book_copies + 1;
									
									if ($new_book_copies == '0') {
										$remark = 'Not Available';
									} else {
										$remark = 'Available';
									}
									
									mysqli_query($con,"UPDATE book SET book_copies = '$new_book_copies' where book_id = '$book_id'") or die (mysqli_error());
									mysqli_query($con,"UPDATE book SET remarks = '$remark' where book_id = '$book_id' ") or die (mysqli_error());
								
									$timezone = "Asia/Manila";
									if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
									$cur_date = date("Y-m-d H:i:s");
									$date_returned_now = date("Y-m-d H:i:s");
									//$due_date = strtotime($cur_date);
									//$due_date = strtotime("+3 day", $due_date);
									//$due_date = date('F j, Y g:i a', $due_date);
									///$checkout = date('m/d/Y', strtotime("+1 day", strtotime($due_date)));			
									
									$penalty_amount_query= mysqli_query($con,"select * from penalty order by penalty_id DESC ") or die (mysqli_error());
									$penalty_amount = mysqli_fetch_assoc($penalty_amount_query);
									
									if ($date_returned > $due_date) {
										$penalty = round((float)(strtotime($date_returned) - strtotime($due_date)) / (60 * 60 *24) * ($penalty_amount['penalty_amount']));
									} elseif ($date_returned < $due_date) {
										$penalty = 'No Penalty';
									} else {
										$penalty = 'No Penalty';
									}
								
									mysqli_query($con,"UPDATE borrow_book SET borrowed_status = 'returned', date_returned = '$date_returned_now', book_penalty = '$penalty' WHERE borrow_book_id= '$borrow_book_id' and user_id = '$user_id' and book_id = '$book_id' ") or die (mysqli_error());
									
									mysqli_query($con,"INSERT INTO return_book (user_id, book_id, date_borrowed, due_date, date_returned, book_penalty)
									values ('$user_id', '$book_id', '$date_borrowed', '$due_date', '$date_returned', '$penalty')") or die (mysqli_error());
									
									$report_history1=mysqli_query($con,"select * from admin where admin_id = $id_session ") or die (mysqli_error());
									$report_history_row1=mysqli_fetch_array($report_history1);
									$admin_row1=$report_history_row1['firstname']." ".$report_history_row1['middlename']." ".$report_history_row1['lastname'];	
									
									mysqli_query($con,"INSERT INTO report 
									(book_id, user_id, admin_name, detail_action, date_transaction)
									VALUES ('$book_id','$user_id','$admin_row1','Returned Book',NOW())") or die(mysqli_error());
									
							?>
									<script>
										// document.getElementById('savenBtn').addEventListener("click", function(){
										// 	var myModal = new bootstrap.Modal(document.getElementById('modalQR'));
										// 	myModal.show();
										// })
										// window.location="reserve_book.php?school_number=<?php echo $school_number ?>";
									</script>
							<?php 
																}
							?>
							
							</tbody>
							</table>
						</div>
						
					<div class="row" style="margin-top:30px;">
						<form method="post">
							<div class="col-xs-4">
                                <input type="datetime-local" name="pickup_date" class="form-control"/>
                            </div>
							<div class="col-xs-4">
								<input type="text" style="margin-bottom:10px; margin-left:-9px;" class="form-control" name="barcode" placeholder="Enter barcode here....." autofocus required />
							</div>
						</form>
						<table class="table table-bordered" id="reload">
							<form method="post" action="">
							<th style="width:100px;">Book Image</th>
							<th>Barcode</th>
							<th>Title</th>
							<th>Author</th>
							<th>ISBN</th>
							<th>Status</th>
							<th>Action</th>
							<?php 
								if (isset($_POST['barcode'])){
									$barcode = $_POST['barcode'];
									$pickup_date = $_POST['pickup_date'];
									
									$book_query = mysqli_query($con,"SELECT * FROM book WHERE book_barcode = '$barcode' ") or die (mysqli_error());
									$book_count = mysqli_num_rows($book_query);
									$book_row = mysqli_fetch_array($book_query);
									
									if ($book_count==0){
										// if ($book_row['book_barcode'] != $barcode){
										echo '
											<table>
												<tr>
													<td class="alert alert-info">No match for the barcode entered!</td>
												</tr>
											</table>
										';
									} elseif ($barcode == '') {
										echo '
											<table>
												<tr>
													<td class="alert alert-info">Enter the correct details!</td>
												</tr>
											</table>
										';
									}else{
							?>
							<tr>
							<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_row['user_id'] ?>">
							<input type="hidden" name="book_id" id="book_id" value="<?php echo $book_row['book_id'] ?>">
							<input type="hidden" name="pickdate" id="pickdate" value="<?php echo $pickup_date ?>">

							<td>
							<?php if($book_row['book_image'] != ""): ?>
							<img src="../upload/<?php echo $book_row['book_image']; ?>" width="100px" height="100px" style="border:4px groove #CCCCCC; border-radius:5px;">
							<?php else: ?>
							<img src="../images/book_image.jpg" width="150px" height="180px" style="border:4px groove #CCCCCC; border-radius:5px;">
							<?php endif; ?>
							</td> 
							<td><?php echo $book_row['book_barcode'] ?></td>
							<td style="text-transform: capitalize"><?php echo $book_row['book_title'] ?></td>
							<td style="text-transform: capitalize"><?php echo $book_row['author'] ?></td>
							<td><?php echo $book_row['isbn'] ?></td>
							<td><?php echo $book_row['status'] ?></td>
							<td>
									<!-- <a class="btn btn-info" for="DeleteAdmin" href="#modalQR" data-toggle="modal" data-target="#modalQR">
										Reserve
									</a> -->
									<button  type="button" name="borrow" id="savenBtn" class="btn btn-info" onClick='reserveBook()'><i class="fa fa-check"></i> Reserve</button>
									<div class="modal fade" id="modalQR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> QR</h4>
											</div>
											<div class="modal-body">
													<div class="alert alert-success" style="text-align:center;" id="qr-container">
														<!-- <img src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data=<?php echo $school_number; ?>" alt="QR Code"> -->
														<!-- <a href="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data=<?php echo $book_id; ?>" download="qrcode.png" target="_blank">
															<img src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data=<?php echo $book_id; ?>" alt="QR Code">
														</a> -->
													</div>
													<div class="modal-footer">
													<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> Close</button>
													
											</div>
											</div>
										</div>
									</div>
								<!-- <button type="button" name="borrow" id="savenBtn" class="btn btn-info"><i class="fa fa-check"></i> Reserve</button> -->
							</td>
							</tr>
							<?php } }?>

							<?php
							
							$allowable_days_query= mysqli_query($con,"select * from allowed_days order by allowed_days_id DESC ") or die (mysqli_error());
							$allowable_days_row = mysqli_fetch_assoc($allowable_days_query);
							
							$timezone = "Asia/Manila";
							if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
							$cur_date = date("Y-m-d H:i:s");
							$date_borrowed = date("Y-m-d H:i:s");
							$due_date = strtotime($cur_date);
							$due_date = strtotime("+".$allowable_days_row['no_of_days']." day", $due_date);
							$due_date = date('Y-m-d H:i:s', $due_date);
							///$checkout = date('m/d/Y', strtotime("+1 day", strtotime($due_date)));
							?>
							<input type="hidden" name="due_date" class="new_text" id="due_date" value="<?php echo $due_date ?>" size="16" maxlength="10"  />
							<input type="hidden" name="date_borrowed" class="new_text" id="date_borrowed" value="<?php echo $date_borrowed ?>" size="16" maxlength="10"  />
							
							<?php 
								// if (isset($_POST['borrow'])){
									// $user_id =$_POST['user_id'];
									// $book_id =$_POST['book_id'];
									// $date_borrowed =$_POST['date_borrowed'];
									// $due_date =$_POST['due_date'];
									// $pickdate =$_POST['pickdate'];
									
									// $trapBookCount= mysqli_query($con,"SELECT count(*) as books_allowed from borrow_book where user_id = '$user_id' and borrowed_status = 'borrowed'") or die (mysqli_error());
									
									// $countBorrowed = mysqli_fetch_assoc($trapBookCount);
									
									// $bookCountQuery= mysqli_query($con,"SELECT count(*) as book_count from borrow_book where user_id = '$user_id' and borrowed_status = 'borrowed' and book_id = $book_id") or die (mysqli_error());
									
									// $bookCount = mysqli_fetch_assoc($bookCountQuery);
									
									// $allowed_book_query= mysqli_query($con,"select * from allowed_book order by allowed_book_id DESC ") or die (mysqli_error());
									// $allowed = mysqli_fetch_assoc($allowed_book_query);
									
									// if ($countBorrowed['books_allowed'] == $allowed['qntty_books']){
									// 	echo "<script>alert(' ".$allowed['qntty_books']." ".'Books Allowed per User!'." '); window.location='reserve_book.php?school_number=".$school_number."'</script>";
									// }elseif ($bookCount['book_count'] == 1){
									// 	echo "<script>alert('Book Already Borrowed!'); window.location='reserve_book.php?school_number=".$school_number."'</script>";
									// }else{
										
									// 	$update_copies = mysqli_query($con,"SELECT * from book where book_id = '$book_id' ") or die (mysqli_error());
									// 	$copies_row= mysqli_fetch_assoc($update_copies);
										
									// 	$book_copies = $copies_row['book_copies'];
									// 	$new_book_copies = $book_copies - 1;
										
									// 	if ($new_book_copies < 0){
									// 		echo "<script>alert('Book out of Copy!'); window.location='reserve_book.php?school_number=".$school_number."'</script>";
									// 	}elseif ($copies_row['status'] == 'Damaged'){
									// 		echo "<script>alert('Book Cannot Borrow At This Moment!'); window.location='reserve_book.php?school_number=".$school_number."'</script>";
									// 	}elseif ($copies_row['status'] == 'Lost'){
									// 		echo "<script>alert('Book Cannot Borrow At This Moment!'); window.location='reserve_book.php?school_number=".$school_number."'</script>";
									// 	}else{
											
									// 		// if ($new_book_copies == '0') {
									// 		// 	$remark = 'Not Available';
									// 		// } else {
									// 		// 	$remark = 'Available';
									// 		// }
											
									// 		// mysqli_query($con,"UPDATE book SET book_copies = '$new_book_copies' where book_id = '$book_id' ") or die (mysqli_error());
									// 		// mysqli_query($con,"UPDATE book SET remarks = '$remark' where book_id = '$book_id' ") or die (mysqli_error());
											
									// 		mysqli_query($con,"INSERT INTO borrow_book(user_id,book_id,date_borrowed,pickup_date,borrowed_status)
									// 		VALUES('$user_id','$book_id','$date_borrowed','$pickdate','reserve')") or die (mysqli_error());
											
									// 		// $report_history=mysqli_query($con,"select * from user where user_id = $id_session ") or die (mysqli_error());
									// 		// $report_history_row=mysqli_fetch_array($report_history);
									// 		// $admin_row=$report_history_row['firstname']." ".$report_history_row['middlename']." ".$report_history_row['lastname'];	
											
									// 		// mysqli_query($con,"INSERT INTO report 
									// 		// (book_id, user_id, admin_name, detail_action, date_transaction)
									// 		// VALUES ('$book_id','$user_id','$admin_row','Borrowed Book',NOW())") or die(mysqli_error());

									// 	}
									// }
							?>
									<!-- <script>
										document.getElementById('savenBtn').addEventListener("click", function(){
											var myModal = new bootstrap.Modal(document.getElementById('modalQR'));
											myModal.show();
										})
									</script> -->
									<!-- window.location="reserve_book.php?school_number=<?php echo $school_number ?>"; -->
							<?php	
								// }
							?>
							<input type="hidden" id="school_number" value="<?php echo $school_number; ?>">
							</form>
						</table>
						
					</div>
				</div>
						
						
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
<script>
	function reserveBook(){
		
        var user_id = document.getElementById("user_id").value; 
        var book_id = document.getElementById("book_id").value; 
        var date_borrowed = document.getElementById("date_borrowed").value; 
        var due_date = document.getElementById("due_date").value; 
        var pickdate = document.getElementById("pickdate").value; 
        var school_number = document.getElementById("school_number").value; 
        var redirect = "reservebook_save.php";
        $.ajax({
            // data:"user_id="+user_id+"&book_id="+book_id+"&date_borrowed="+date_borrowed+"&due_date="+due_date+"&pickdate="+pickdate+"&school_number="+school_number,
			data: {
				user_id: user_id,
				book_id: book_id,
				date_borrowed: date_borrowed,
				due_date: due_date,
				pickdate: pickdate,
				school_number: school_number
			},
            type: "POST",
            url: redirect,
            success: function(output){
				var substring="<script>"
				if(output.includes(substring)==true){
					alert('Error Try Again!')
				}else{
					var qrLink = document.createElement("a");
					qrLink.href = "https://api.qrserver.com/v1/create-qr-code/?size=100x100&data="+book_id+'-'+output;
					qrLink.download = "qrcode.png";
					qrLink.target = "_blank";
					// Create the image element
					var qrImage = document.createElement("img");
					qrImage.src = "https://api.qrserver.com/v1/create-qr-code/?size=90x90&data="+book_id+'-'+output;
					qrImage.alt = "QR Code";

					// Append image inside anchor tag
					qrLink.appendChild(qrImage);

					// Append anchor tag to the container
					document.getElementById("qr-container").appendChild(qrLink);
					document.getElementById("savenBtn").disabled = true;
					$("#modalQR").modal('show');
				}
            }
        });
    }
</script>
<!-- <script>
	// $(document).ready(function(){
		function popupQR(){
			document.getElementById('modalQR')style.display = "block";
			// myModal.show();
		}
	// $(document).ready(function(){
		// document.getElementById('savenBtn').addEventListener("click", function(){
			
		// });
	// });
</script> -->
<!-- <script type="text/javascript">
	$(document).on('click', '#savenBtn', function(e){
		alert('hi')
		document.getElementById('modalQR')style.display = "block";
		// e.preventDefault();
		// document.getElementById('modalQR')style.display = "block";
	});
</script> -->
<?php include ('footer.php'); ?>