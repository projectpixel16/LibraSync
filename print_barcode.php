<?php 
include('session.php');
include ('include/dbcon.php');

?>
<html>

<head>
		<title>  LibraSync</title>
		
		<style>
		
		
.container {
	width:100%;
	margin:auto;
}
		
.table {
    width: 100%;
    margin-bottom: 20px;
}	

.table-striped tbody > tr:nth-child(odd) > td,
.table-striped tbody > tr:nth-child(odd) > th {
    background-color: #f9f9f9;
}

@media print{
#print {
display:none;
}
}

#print {
	width: 90px;
    height: 30px;
    font-size: 18px;
    background: white;
    border-radius: 4px;
	margin-left:28px;
	cursor:hand;
}
		
		</style>
<script>
function printPage() {
    window.print();
}
</script>
		
</head>


<body>
	<div class = "container">
		<div id = "header">
		<br/>
				  
				<center><h5 style = "font-style:Calibri"></h5>&nbsp; &nbsp;&nbsp;  &nbsp;	&nbsp; </center>
				<center><h5 style = "font-style:Calibri; margin-top:-14px;"></h5> &nbsp; &nbsp;   LibraSync</center>
				<center><h5 style = "font-style:Calibri; margin-top:-14px;"></h5> Rafael M. Salas Memorial Library</center>
			
<button type="submit" id="print" onclick="printPage()">Print</button>	
			<p style = "margin-left:30px; margin-top:50px; font-size:14pt; font-weight:bold;">Users QR Code&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <div align="right">
		<b style="color:blue;">Date Prepared:</b>
		<?php include('currentdate.php'); ?>
        </div>			
		<br/>
		<br/>
<?php
							$result= mysqli_query($con,"select * from user order by user_id DESC") or die (mysqli_error());
?>
						<table class="table">
						  <thead>
								<tr>
									<th>QR Code Image</th>
									<th>School ID</th>
									<th>Full Name</th>
									<!-- <th>Level</th> -->
								</tr>
						  </thead>   
						  <tbody>
<?php
							while ($row= mysqli_fetch_array ($result) ){
							$id=$row['user_id'];
?>
							<tr>
								<!-- <td style="text-align:center;"><?php	echo "<img src = 'BCG/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=Arial.ttf&font_size=10&text=".$row['school_number']."&thickness=50&start=NULL&code=BCGcode128' />";?></td> -->
								<td style="text-align:center;">
									<img src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data=<?php echo $row['school_number']; ?>" alt="QR Code">
								</td>
								<td style="text-align:center;"><?php echo $row['school_number']; ?></td> 
								<td style="text-align:center;"><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></td>
								<!-- <td style="text-align:center;"><?php echo $row['level']; ?></td> -->
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							
							<?php 
							}					
							?>
						  </tbody> 
					  </table> 

<br />
<br />
							<?php
								include('include/dbcon.php');
								$user_query=mysqli_query($con,"select * from admin where admin_id='$id_session'")or die(mysqli_error());
								$row=mysqli_fetch_array($user_query); {
							?>        <h2><i class="glyphicon glyphicon-user"></i> <?php echo '<span style="color:blue; font-size:15px;">Prepared by:'."<br /><br /> ".$row['firstname']." ".$row['lastname']." ".'</span>';?></h2>
								<?php } ?>


			</div>
	
	
	
	

	</div>
</body>


</html>