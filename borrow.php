<?php include ('header.php'); ?>
<!-- <script src="https://unpkg.com/html5-qrcode"></script> -->
<script type="text/javascript" charset="utf-8" language="javascript" src="js/html5-qrcode.min.js"></script>
<style>
	#reader {
		width: 300px;
		margin: auto;
	}
</style>
        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Home /</small> Borrow
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
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

<!-- <div class="container-fluid"> -->
<!-- <div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4"> -->
		<?php if(!isset($_GET['school_number'])){ ?>
						<form method="post" action="">
								<div class="col-lg-3"></div>
								<div class="col-lg-4">
									<select name="school_number" class="select2_single form-control" required="required" tabindex="-1" >
									<option value="0">Select School ID Number</option>
									<?php
									$result= mysqli_query($con,"select * from user where status = 'Active' and archive='0' ") or die (mysqli_error());
									while ($row= mysqli_fetch_array ($result) ){
									// $id=$row['user_id'];
									?>
										<option value="<?php echo $row['school_number']; ?>"><?php echo $row['school_number']; ?> - <?php echo $row['firstname']; ?></option>
									<?php } ?>
									</select>
								</div>
						<!-- <br />
						<br /> -->
								<div class="col-lg-2" style="margin-top:3px!important;margin-left:0px!important;">
									<button name="submit" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-log-in"></i> Submit</button>
								</div>
								<div class="col-lg-3"></div>
						</form>

<?php
		}
	include ('include/dbcon.php');

	if (isset($_POST['submit'])) {

	$school_number = $_POST['school_number'];

	$sql = mysqli_query($con,"SELECT * FROM user WHERE school_number = '$school_number' ");
	$count = mysqli_num_rows($sql);
	$row = mysqli_fetch_array($sql);

		if($count <= 0){
			echo "<div class='alert alert-success'>".'No match found for the School ID Number'."</div>";
		}else{
			$school_number = $_POST['school_number'];
			echo ('<script> location.href="borrow_book.php?school_number='.$school_number.'";</script');
		}
	}
?>

	<!-- </div>
	<div class="col-md-4"></div>
</div> -->
<!-- </div>			 -->
<div class="x_content">
                        <!-- content starts here -->

						<div class="table-responsive">							
							<?php
							$where ="";
							if(isset($_GET['school_number'])){
								$where = " and school_number='".$_GET['school_number']."'";
								// $where = " and (date(borrow_book.date_borrowed) between '".date("Y-m-d",strtotime($_GET['datefrom']))."' and '".date("Y-m-d",strtotime($_GET['dateto']))."' ) ";
							}
							

							$return_query= mysqli_query($con,"SELECT borrow_book.borrow_book_id,borrow_book.user_id,borrow_book.book_id,borrow_book.book_penalty,borrow_book.due_date,borrow_book.date_borrowed,borrow_book.status,book.book_barcode,book.book_title,user.firstname,user.lastname,borrow_book.pickup_date,borrow_book.borrowed_status from borrow_book 
							LEFT JOIN book ON borrow_book.book_id = book.book_id 
							LEFT JOIN user ON borrow_book.user_id = user.user_id 
							where (borrow_book.borrowed_status = 'borrowed' OR borrow_book.borrowed_status = 'borrow' OR borrow_book.borrowed_status = 'reserve')  $where order by borrow_book.date_borrowed DESC") or die (mysqli_error());
								$return_count = mysqli_num_rows($return_query);
								
							// $count_penalty = mysqli_query($con,"SELECT sum(book_penalty) FROM return_book ")or die(mysqli_error());
							// $count_penalty_row = mysqli_fetch_array($count_penalty);
							
							?>
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                <!-- <div class="pull-left">
                                    <div class="span"><div class="alert alert-info"><i class="icon-credit-card icon-large"></i>&nbsp;Total Amount of Penalty:&nbsp;<?php echo "Php ".$count_penalty_row['sum(book_penalty)'].".00"; ?></div></div>
                                </div> -->
							<thead>
								<tr>
									<th>Barcode</th>
									<th>Borrower Name</th>
									<th>Title</th>
								<!---	<th>Author</th>
									<th>ISBN</th>	-->
									<th>Date Borrowed</th>
									<th>Due Date</th>
									<th>Pickup Date</th>
									<th>Action</th>
									<!-- <th>Date Returned</th> -->
									<!-- <th>Penalty</th> -->
								</tr>
							</thead>
							
							<tbody>
<?php
							while ($return_row= mysqli_fetch_array ($return_query) ){
							$id=$return_row['borrow_book_id'];
							$user_id=$return_row['user_id'];
							$book_id=$return_row['book_id'];
?>
				
							<tr>
								<td><?php echo $return_row['book_barcode']; ?></td>
								<td style="text-transform: capitalize"><?php echo $return_row['firstname']." ".$return_row['lastname']; ?></td>
								<td style="text-transform: capitalize"><?php echo $return_row['book_title']; ?></td>
							<!---	<td style="text-transform: capitalize"><?php // echo $return_row['author']; ?></td>
								<td><?php // echo $return_row['isbn']; ?></td>	-->
								<td><?php echo date("M d, Y h:m:s a",strtotime($return_row['date_borrowed'])); ?></td>
								<?php
								 if ($return_row['book_penalty'] != 'No Penalty'){
									if($return_row['due_date']!='0000-00-00 00:00:00'){
									 	echo "<td class='' style='width:100px;'>".date("M d, Y h:m:s a",strtotime($return_row['due_date']))."</td>";
									}else{
										echo "<td class='' style='width:100px;'></td>";
									}
								 }else {
									if($return_row['due_date']!='0000-00-00 00:00:00'){
									 	echo "<td>".date("M d, Y h:m:s a",strtotime($return_row['due_date']))."</td>";
									}else{
										echo "<td></td>";
									}
								 }
								
								?>
								<td><?php $timestamp = strtotime($return_row['pickup_date']); echo ($return_row['pickup_date']!='') ? date("M d, Y h:m:s a", $timestamp) : '' ?></td>
								<td>
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
									<?php if($return_row['status']==0){?>
									<form method="POST" action="">	
										<button name="accepted" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Accept</button>
										<button name="declined" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Decline</button>
											<input type="hidden" name="due_date" class="new_text" id="due_date" value="<?php echo $due_date ?>" size="16" maxlength="10"  />
											<input type="hidden" name="date_borrowed" class="new_text" id="date_borrowed" value="<?php echo $date_borrowed ?>" size="16" maxlength="10"  />
											<?php 
												if (isset($_POST['accepted'])){
													$date_borrowed =$_POST['date_borrowed'];
													$due_date =$_POST['due_date'];
													
													$trapBookCount= mysqli_query($con,"SELECT count(*) as books_allowed from borrow_book where user_id = '$user_id' and borrowed_status = 'borrowed'") or die (mysqli_error());
													
													$countBorrowed = mysqli_fetch_assoc($trapBookCount);
													
													$bookCountQuery= mysqli_query($con,"SELECT count(*) as book_count from borrow_book where user_id = '$user_id' and borrowed_status = 'borrowed' and book_id = $book_id") or die (mysqli_error());
													
													$bookCount = mysqli_fetch_assoc($bookCountQuery);
													
													$allowed_book_query= mysqli_query($con,"select * from allowed_book order by allowed_book_id DESC ") or die (mysqli_error());
													$allowed = mysqli_fetch_assoc($allowed_book_query);
													
													if ($countBorrowed['books_allowed'] == $allowed['qntty_books']){
														echo "<script>alert(' ".$allowed['qntty_books']." ".'Books Allowed per User!'." '); window.location='borrowed.php'</script>";
													}elseif ($bookCount['book_count'] == 1){
														echo "<script>alert('Book Already Borrowed!'); window.location='borrowed.php'</script>";
													}else{
														
														$update_copies = mysqli_query($con,"SELECT * from book where book_id = '$book_id' ") or die (mysqli_error());
														$copies_row= mysqli_fetch_assoc($update_copies);
														
														$book_copies = $copies_row['book_copies'];
														$new_book_copies = $book_copies - 1;
														
														if ($new_book_copies < 0){
															echo "<script>alert('Book out of Copy!'); window.location='borrowed.php'</script>";
														}elseif ($copies_row['status'] == 'Damaged'){
															echo "<script>alert('Book Cannot Borrow At This Moment!'); window.location='borrowed.php'</script>";
														}elseif ($copies_row['status'] == 'Lost'){
															echo "<script>alert('Book Cannot Borrow At This Moment!'); window.location='borrowed.php'</script>";
														}else{
															
															if ($new_book_copies == '0') {
																$remark = 'Not Available';
															} else {
																$remark = 'Available';
															}
															
															// mysqli_query($con,"UPDATE book SET book_copies = '$new_book_copies' where book_id = '$book_id' ") or die (mysqli_error());
															// mysqli_query($con,"UPDATE book SET remarks = '$remark' where book_id = '$book_id' ") or die (mysqli_error());
															
															// mysqli_query($con,"INSERT INTO borrow_book(user_id,book_id,date_borrowed,borrowed_status)
															// VALUES('$user_id','$book_id','$date_borrowed','reserve')") or die (mysqli_error());

															mysqli_query($con,"UPDATE borrow_book SET borrowed_status = 'reserve', status='1' where borrow_book_id = '$id' ") or die (mysqli_error());
															
															$report_history=mysqli_query($con,"select * from admin where admin_id = $id_session ") or die (mysqli_error());
															$report_history_row=mysqli_fetch_array($report_history);
															$admin_row=$report_history_row['firstname']." ".$report_history_row['middlename']." ".$report_history_row['lastname'];	
															
															mysqli_query($con,"INSERT INTO report 
															(book_id, user_id, admin_name, detail_action, date_transaction)
															VALUES ('$book_id','$user_id','$admin_row','Reserved Book',NOW())") or die(mysqli_error());
															
															mysqli_query($con,"INSERT INTO notifications 
															(user_id, message, status)
															VALUES ('$user_id','The admin has accepted your request to reserve ".$copies_row['book_title']."','unread')") or die(mysqli_error());
														}
													}
											?>
											<script>
												window.location="borrow.php";
												// window.location="borrowed.php";
											</script>
											<?php } 
												if (isset($_POST['declined'])){
													mysqli_query($con,"UPDATE borrow_book SET borrowed_status = 'declined', status='2' where borrow_book_id = '$id' ") or die (mysqli_error());
											?>
											<script>
												window.location="borrow.php";
											</script>
											<?php
												}
											?>

										</form>
									<?php }else if($return_row['status']==1){ ?>
										
										<!-- <a class="btn btn-info" for="modalQR" href="#modalQR" data-toggle="modal" data-target="#modalQR" onclick="startScanner()">
											Borrow
										</a>
										<div class="modal fade" id="modalQR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> QR</h4>
													</div>
													<div class="modal-body">
														<h2>QR Code Scanner</h2>
														<div id="reader"></div>
														<p>Scanned Result: <span id="result"></span></p>
														<div class="modal-footer">
															<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> Close</button>
													</div>
												</div>
											</div>
										</div> -->
										<form method="POST" action="">
											<?php if($return_row['borrowed_status']!='borrowed'){ ?>
												<button name="borrow" class="btn btn-info">Borrow</button>
											<?php 
												if (isset($_POST['borrow'])){ 
													$trapBookCount= mysqli_query($con,"SELECT count(*) as books_allowed from borrow_book where user_id = '$user_id' and borrowed_status = 'borrowed'") or die (mysqli_error());

													$countBorrowed = mysqli_fetch_assoc($trapBookCount);

													$bookCountQuery= mysqli_query($con,"SELECT count(*) as book_count from borrow_book where user_id = '$user_id' and borrowed_status = 'borrowed' and book_id = $book_id") or die (mysqli_error());

													$bookCount = mysqli_fetch_assoc($bookCountQuery);

													$allowed_book_query= mysqli_query($con,"select * from allowed_book order by allowed_book_id DESC ") or die (mysqli_error());
													$allowed = mysqli_fetch_assoc($allowed_book_query);

													if ($countBorrowed['books_allowed'] == $allowed['qntty_books']){
														if(isset($_GET['school_number'])){
															echo "<script>alert(' ".$allowed['qntty_books']." ".'Books Allowed per User!'." '); window.location='borrow.php?school_number=".$_GET['school_number']."'</script>";
														}else{
															echo "<script>alert(' ".$allowed['qntty_books']." ".'Books Allowed per User!'." '); window.location='borrow.php'</script>";
														}
													}elseif ($bookCount['book_count'] == 1){
														if(isset($_GET['school_number'])){
															echo "<script>alert('Book Already Borrowed!'); window.location='borrow.php?school_number=".$_GET['school_number']."'</script>";
														}else{
															echo "<script>alert('Book Already Borrowed!'); window.location='borrow.php'</script>";
														}
													}else{
														
														$update_copies = mysqli_query($con,"SELECT * from book where book_id = '$book_id' ") or die (mysqli_error());
														$copies_row= mysqli_fetch_assoc($update_copies);
														
														$book_copies = $copies_row['book_copies'];
														$new_book_copies = $book_copies - 1;
														
														if ($new_book_copies < 0){
															echo "<script>alert('Book out of Copy!'); window.location='borrow.php'</script>";
														}elseif ($copies_row['status'] == 'Damaged'){
															echo "<script>alert('Book Cannot Borrow At This Moment!'); window.location='borrow.php'</script>";
														}elseif ($copies_row['status'] == 'Lost'){
															echo "<script>alert('Book Cannot Borrow At This Moment!'); window.location='borrow.php'</script>";
														}else{
															
															if ($new_book_copies == '0') {
																$remark = 'Not Available';
															} else {
																$remark = 'Available';
															}
															
															mysqli_query($con,"UPDATE book SET book_copies = '$new_book_copies' where book_id = '$book_id' ") or die (mysqli_error());
															mysqli_query($con,"UPDATE book SET remarks = '$remark' where book_id = '$book_id' ") or die (mysqli_error());
															
															// mysqli_query($con,"INSERT INTO borrow_book(user_id,book_id,date_borrowed,due_date,borrowed_status)
															// VALUES('$user_id','$book_id','$date_borrowed','$due_date','borrow')") or die (mysqli_error());

															mysqli_query($con,"UPDATE borrow_book SET borrowed_status = 'borrowed', status='1',due_date='$due_date' where borrow_book_id = '$id' ") or die (mysqli_error());
															
															$report_history=mysqli_query($con,"select * from admin where admin_id = $id_session ") or die (mysqli_error());
															$report_history_row=mysqli_fetch_array($report_history);
															$admin_row=$report_history_row['firstname']." ".$report_history_row['middlename']." ".$report_history_row['lastname'];	
															
															mysqli_query($con,"INSERT INTO report 
															(book_id, user_id, admin_name, detail_action, date_transaction)
															VALUES ('$book_id','$user_id','$admin_row','Borrowed Book',NOW())") or die(mysqli_error());
															
															mysqli_query($con,"INSERT INTO notifications 
															(user_id, message, status)
															VALUES ('$user_id','The admin has accepted your request to borrow ".$copies_row['book_title']."','unread')") or die(mysqli_error());
														}
													}
												} 
											}
											} 
											?>
										</form>
								</td>
							</tr>
							<input type="hidden" name="borrow_book_id" class="new_text" id="borrow_book_id" value="<?php echo $id ?>" size="16" maxlength="10"  />
							<input type="hidden" name="user_id" class="new_text" id="user_id" value="<?php echo $user_id ?>" size="16" maxlength="10"  />
							<input type="hidden" name="book_id" class="new_text" id="book_id" value="<?php echo $book_id ?>" size="16" maxlength="10"  />
							<input type="hidden" name="id_session" class="new_text" id="id_session" value="<?php echo $id_session ?>" size="16" maxlength="10"  />
							<?php 
							}
							if ($return_count <= 0){
								echo '
									<table style="float:right;">
										<tr>
											<td style="padding:10px;" class="alert alert-danger">No Books returned at this moment</td>
										</tr>
									</table>
								';
							} 							
							?>
							</tbody>
							
							</table>
						</div>
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>
<script>
	function onScanSuccess(decodedText, decodedResult) {
		// document.getElementById("result").innerText = decodedText;
		let IDS = decodedText.split("-"); 
		var book_id = IDS[0];
		var borrow_book_id = IDS[1];
		// alert(IDS[0])
		alert('Successfully Borrowed!');
		window.location="borrow.php";
		// alert('hi')
		// // var user_id = document.getElementById("user_id").value; 
		
		// var date_borrowed = document.getElementById("date_borrowed").value; 
		// // var due_date = document.getElementById("due_date").value; 
		// // var book_id = document.getElementById("book_id").value; 
		// // var borrow_book_id = document.getElementById("borrow_book_id").value; 
		// // var id_session = document.getElementById("id_session").value; 
        // var redirect = "reserve_qrsave.php";
		
        // $.ajax({
		// 	data: {
		// 		// user_id: user_id,
		// 		// book_id: book_id,
		// 		date_borrowed: date_borrowed,
		// 		// due_date: due_date,
		// 		// borrow_book_id: borrow_book_id,
		// 		// id_session: id_session
		// 	},
        //     type: "POST",
        //     url: redirect,
        //     success: function(output){
		// 		console.log("Server Response: ", output);
		// 		alert('hello')
		// 		// window.location="borrow.php";
        //     }
        // });
		
	}

	function startScanner() {
		Html5Qrcode.getCameras().then(devices => {
			if (devices && devices.length) {
				let cameraId = devices[0].id; // Use first available camera
				let scanner = new Html5Qrcode("reader");
				scanner.start(
					cameraId,
					{ fps: 10, qrbox: { width: 250, height: 250 } },
					onScanSuccess
				).catch(err => console.log("Scanner Error: ", err));
			} else {
				console.log("No camera devices found.");
			}
		}).catch(err => console.log("Camera access error: ", err));
	}

	// Start scanner when page loads
	// startScanner();
</script>
<?php include ('footer.php'); ?>