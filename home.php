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
	$sql = "SELECT COUNT(borrow_book.user_id) AS borrow_count, school_name FROM borrow_book INNER JOIN user ON borrow_book.user_id=user.user_id WHERE borrow_book.status='1' GROUP BY school_name ORDER BY school_name ASC";
	$result = $con->query($sql);

	$dataPoints = [];
	while ($row = $result->fetch_assoc()) {
		$dataPoints[] = [
			'y' => $row['borrow_count'],
			"label" => $row['school_name']
		];
	}

	$sqlpie = "SELECT COUNT(book.category_id) AS borrow_count_pie, category.classname,borrow_book.book_id FROM borrow_book INNER JOIN book ON borrow_book.book_id=book.book_id INNER JOIN category ON book.category_id=category.category_id WHERE borrow_book.status='1' GROUP BY borrow_book.book_id ORDER BY book.category_id ASC";
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
 
	$sqlline = "SELECT user.type, COUNT(DISTINCT borrow_book.user_id) AS borrowline_count FROM borrow_book INNER JOIN user ON borrow_book.user_id=user.user_id WHERE borrow_book.status='1' GROUP BY user.type ORDER BY user.type ASC";
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
			data: [{
				type: "splineArea",
				yValueFormatString: "#,##0.##",
				dataPoints: <?php echo json_encode($dataPointsUsers, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chartline.render();
	}
</script>
<div class="row">
	<div class='col-lg-4'>
		<div id="chartContainer" style="height: 370px; width: 100%;"></div>
	</div>
	<div class='col-lg-4'>
		<div id="chartContainerPie" style="height: 370px; width: 100%;"></div>
	</div>
	<div class='col-lg-4'>
		<div id="chartContainerLine" style="height: 370px; width: 100%;"></div>
	</div>
</div>
<script src="js/canvasjs.min.js"></script>
<?php include ('footer.php'); ?>