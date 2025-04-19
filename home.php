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
 
?>
<script>
	window.onload = function() {
	var chart = new CanvasJS.Chart("chartContainer", {
		animationEnabled: true,
		theme: "light2",
		title:{
			text: "Borrower's Per School"
		},
		axisY: {
			title: "Borrower's Per School"
		},
		data: [{
			type: "column",
			yValueFormatString: "#,##0.##",
			dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
		}]
	});
	chart.render();
	
	}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="js/canvasjs.min.js"></script>
<?php include ('footer.php'); ?>