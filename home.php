<?php include ('header.php'); ?>
        <div class="clearfix"></div>
		
                <!-- top tiles -->
                <div class="row tile_count" style="margin-right:-245px;">
					 <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        
                        <div class="right">
							<?php
							$result = mysqli_query($con,"SELECT * FROM admin");
							$num_rows = mysqli_num_rows($result);
							?>
								<a href="admin.php">
                            		<span class="count_top"><i class="fa fa-users"></i> Admin</span>
								</a>
                            <div class="count green"><?php echo $num_rows; ?></div>
							<span class="count_bottom"> Total of Admin</span>
                        </div>
                    </div>
					<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        
                        <div class="right">
							<?php
							$result = mysqli_query($con,"SELECT * FROM user");
							$num_rows = mysqli_num_rows($result);
							?>
				<a href="user.php">
                            <span class="count_top"><i class="fa fa-male"></i> <i class="fa fa-female"></i> Students</span>
                            <!-- <span class="count_top"><i class="fa fa-male"></i> <i class="fa fa-female"></i> Student & Teacher</span> -->
				</a>
                            <div class="count green"><?php echo $num_rows; ?></div>
							 <span class="count_bottom">Total of students</span>							
                        </div>
                    </div>
					<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        
                        <div class="right">
							<?php
							$result = mysqli_query($con,"SELECT * FROM book");
							$num_rows = mysqli_num_rows($result);
							?>
				<a href="book.php">
                            <span class="count_top"><i class="fa fa-book"></i> Books</span>
				</a>
                            <div class="count green"><?php echo $num_rows; ?></div>
							 <span class="count_bottom ">Total of Books</span>                     
					  </div>
                    </div>
					<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        
                        <div class="right">
							<?php
							$result = mysqli_query($con,"SELECT * FROM borrow_book");
							$num_rows = mysqli_num_rows($result);
							?>
				<a href="borrowed.php">
                            <span class="count_top"><i class="fa fa-book"></i> Book Borrowed</span>
				</a>
                            <div class="count green"><?php echo $num_rows; ?></div>
							 <span class="count_bottom ">Total of Book Borrowed</span>
                        </div>
                    </div>
					<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                      
                        <div class="right">
							<?php
							$result = mysqli_query($con,"SELECT * FROM return_book");
							$num_rows = mysqli_num_rows($result);
							?>
				<a href="returned_book.php">
                            <span class="count_top"><i class="fa fa-book"></i> Book Returned</span>
				</a>
                            <div class="count green"><?php echo $num_rows; ?></div>
							 <span class="count_bottom ">Total of Book Returned</span>							
                        </div>
                    </div>

                </div>
                <!-- /top tiles -->
<?php
	$sql = "SELECT COUNT(borrow_book.user_id) AS borrow_count, schools.school_name FROM borrow_book INNER JOIN user ON borrow_book.user_id=user.user_id INNER JOIN schools ON user.school_id = schools.school_id WHERE borrow_book.status='1' GROUP BY schools.school_name ORDER BY schools.school_name ASC";
	$result = $con->query($sql);

	$dataPoints = [];
	while ($row = $result->fetch_assoc()) {
		$dataPoints[] = [
			'y' => $row['borrow_count'],
			"label" => $row['school_name']
		];
	}

	$sqlpie = "SELECT COUNT(book.category_id) AS borrow_count_pie, category.classname,borrow_book.book_id FROM borrow_book INNER JOIN book ON borrow_book.book_id=book.book_id INNER JOIN category ON book.category_id=category.category_id WHERE borrow_book.status='1' GROUP BY book.category_id ORDER BY book.category_id ASC";
	$resultpie = $con->query($sqlpie);
	$dataPointsPie = [];
	$overalltotal=0;
	// $overalltotal=mysqli_num_rows($resultpie);
	while ($rowpie = $resultpie->fetch_assoc()) {
		$overalltotal +=$rowpie['borrow_count_pie'];
	}
	$resultpie->data_seek(0);
	while ($rowpie = $resultpie->fetch_assoc()) {
		$count_category = "SELECT COUNT(book.category_id) as count FROM borrow_book INNER JOIN book ON borrow_book.book_id=book.book_id WHERE borrow_book.book_id='$rowpie[book_id]' AND borrow_book.status='1' ORDER BY book.category_id ASC";
		$percentage = round(($rowpie['borrow_count_pie'] / $overalltotal) * 100);
		$dataPointsPie[] = [
			// 'y' => $rowpie['borrow_count_pie'],
			'y' => $percentage,
			"label" => $rowpie['classname']
		];
	}
	
	$filter = (isset($_GET['filter'])) ?  ($_GET['filter']=='all') ? " AND (type = 'Student' OR type = 'Community Member')" : " AND type = '$_GET[filter]'" : '';
	$sqlline = "SELECT user.type, COUNT(DISTINCT borrow_book.user_id) AS borrowline_count FROM borrow_book INNER JOIN user ON borrow_book.user_id=user.user_id WHERE borrow_book.status='1' $filter GROUP BY user.type ORDER BY user.type ASC";
	$resultline = $con->query($sqlline);
	$dataPointsUsers = [];
	while ($rowline = $resultline->fetch_assoc()) {
		$dataPointsUsers[] = [
			'y' => $rowline['borrowline_count'],
			"label" => $rowline['type']
		];
	}
?>
<script>
	window.onload = function() {
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			theme: "dark",
			title:{
				text: "Borrower's Per School"
			},
			axisY: {
				title: "Number of Borrower's Per School"
			},
			data: [{
				type: "column",
				yValueFormatString: "#,##0.##",
				dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();

		var chartpie = new CanvasJS.Chart("chartContainerPie", {
			animationEnabled: true,
			theme: "dark",
			title:{
				text: "Borrower's of books per Category"
			},
			toolTip:{
				content:"{label}: {y}%"
			},
			data: [{
				type: "pie",
				yValueFormatString: "#,##0.##",
				dataPoints: <?php echo json_encode($dataPointsPie, JSON_NUMERIC_CHECK); ?>,
			}]
		});
		chartpie.render();
	
		var chartline = new CanvasJS.Chart("chartContainerLine", {
			animationEnabled: true,
			theme: "dark",
			title:{
				text: "Students and Non-students Borrower's"
			},
			axisY: {
				title: "Students and Non-students"
			},
			legend: { cursor: "pointer", itemclick: function(e) {
				e.dataSeries.visible = !(typeof e.dataSeries.visible === "undefined" || e.dataSeries.visible);
				chartline.render();
			}},
			data: [{
				type: "splineArea",
				yValueFormatString: "#,##0.##",
				dataPoints: <?php echo json_encode($dataPointsUsers, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chartline.render();

		// Filter dropdown
		document.getElementById("filterSelect").addEventListener("change", function () {
			const val = this.value;
			window.location.href = `http://localhost/librasync/home.php?filter=${val}`;
		});
	}

	
</script>
<div class="row">
	<div class='col-lg-12'>
		<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	</div>
</div>
<div class="row">
	<div class='col-lg-6'>
		<label for="filterSelect" style="padding-left: 372px;padding-bottom: 5px;padding-top: 5px; width:100%">
			<select id="filterSelect" class="form-control" style="width:100%;">
				<option value="">--Select Filter--</option>
				<option value="all">All</option>
				<option value="Student">Students</option>
				<option value="Community Member">Non-Students</option>
			</select></label> 
		<div id="chartContainerLine" style="height: 370px; width: 100%;"></div>
	</div>
	<div class='col-lg-6' style='padding-top:50px;'>
		<div id="chartContainerPie" style="height: 370px; width: 100%;"></div>
	</div>
</div>
<!-- <div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12" style="margin-left:276px; float:left;">
					<div class="x_panel">
						<div class="x_title">
							<h2>Unreturned Books Penalty Per Day</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
								<li><a class="close-link"><i class="fa fa-close"></i></a></li>
							</ul>
							<div class="clearfix"></div>
						</div>	
						<div class="x_content">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Name</th>
										<th>Book Name</th>
										<th>Penalty</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$penalty_query= mysqli_query($con,"SELECT * FROM borrow_book INNER JOIN user ON user.user_id = borrow_book.user_id INNER JOIN book ON book.book_id = borrow_book.book_id WHERE date_returned IS NULL AND due_date < CURDATE();") or die (mysqli_error());
										while ($row33= mysqli_fetch_array ($penalty_query) ){
											$penalty_amount_query= mysqli_query($con,"select * from penalty order by penalty_id DESC ") or die (mysqli_error());
											$penalty_amount = mysqli_fetch_assoc($penalty_amount_query);
											
											$due_date = new DateTime($row33['due_date']);
											$today = new DateTime();
											$interval = $due_date->diff($today);
											$days_overdue = $interval->days + 1;
											$penalty = $days_overdue * $penalty_amount['penalty_amount'];
									?>
									<tr>
										<td><?php echo $row33['firstname']." ".$row33['lastname']; ?></td>
										<td><?php echo $row33['book_title']; ?></td>
										<td>
											<?php echo '₱ '.number_format($penalty,2); ?>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
</div> -->
<script src="js/canvasjs.min.js"></script>
<?php include ('footer.php'); ?>