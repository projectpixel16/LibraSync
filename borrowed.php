<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Home /</small> Borrowed Books
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
<!--	<div class="col-xs-3">
		<form method="POST" action="sort_returned_book.php">
		<input type="date" class="form-control" name="sort" value="<?php //echo date('Y-m-d'); ?>">
		<button type="submit" class="btn btn-primary btn-outline" style="margin:-34px -195px 0px 0px; float:right;" name="ok"><i class="fa fa-calendar-o"></i> Sort By Date Returned</button>
		</form>
	</div>
-->
                        <h2><i class="fa fa-book"></i> Borrowed Books Monitoring</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
							<a href="print_borrowed_books.php" target="_blank" style="background:none;">
							<button class="btn btn-danger"><i class="fa fa-print"></i> Print</button>
							</a>
							</li>
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
		<!--- sort -->
						<form method="GET" action="" class="form-inline">
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-3">
                                            <input type="date" style="color:black;" value="<?php echo date('Y-m-d'); ?>" name="datefrom" class="form-control has-feedback-left" placeholder="Date From" aria-describedby="inputSuccess2Status4" required />
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-3">
                                            <input type="date" style="color:black;" value="<?php echo date('Y-m-d'); ?>" name="dateto" class="form-control has-feedback-left" placeholder="Date To" aria-describedby="inputSuccess2Status4" required />
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                                </div>
								
								<button type="submit" name="search" class="btn btn-primary btn-outline"><i class="fa fa-calendar-o"></i> Search</button>
								
						</form>
                    </div>
                       <!--         <div class="pull-right">
                                    <div class="span">
											<form method="POST" target="_blank" action="print_returned_book.php">
												<button name="print" class="btn btn-danger">
													<i class="fa fa-print"></i>
													Print
												</button>
											</form>
									</div>
                                </div>
							-->
                    <div class="x_content">
                        <!-- content starts here -->

						<div class="table-responsive">							
							<?php
							$where ="";
							if(isset($_GET['search'])){
								$where = " and (date(borrow_book.date_borrowed) between '".date("Y-m-d",strtotime($_GET['datefrom']))."' and '".date("Y-m-d",strtotime($_GET['dateto']))."' ) ";
							}
							
							$return_query= mysqli_query($con,"SELECT borrow_book.borrow_book_id,borrow_book.user_id,borrow_book.book_id,borrow_book.book_penalty,borrow_book.due_date,borrow_book.date_borrowed,borrow_book.status,book.book_barcode,book.book_title,user.firstname,user.lastname,borrow_book.pickup_date from borrow_book 
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
									<?php if($return_row['status']==0){?>
									<form method="POST" action="">	
										<button name="accepted" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Accept</button>
										<button name="declined" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Decline</button>
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
											<input type="hidden" name="due_date" class="new_text" id="sd" value="<?php echo $due_date ?>" size="16" maxlength="10"  />
											<input type="hidden" name="date_borrowed" class="new_text" id="sd" value="<?php echo $date_borrowed ?>" size="16" maxlength="10"  />
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

														}
													}
											?>
											<script>
												window.location="borrowed.php";
											</script>
											<?php } 
												if (isset($_POST['declined'])){
													mysqli_query($con,"UPDATE borrow_book SET borrowed_status = 'declined', status='2' where borrow_book_id = '$id' ") or die (mysqli_error());
												}
											?>

										</form>
									<?php } ?>
								</td>
							</tr>
							
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

<?php include ('footer.php'); ?>