<?php 
include('session.php');
include ('../include/dbcon.php');

?>
<html>

<head>
		<title>  LibraSync</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<style>
		
		
.container {
	width:100%;
	margin:auto;
	padding:0px 100px;
}
		
.table {
    width: 100%;
    margin-bottom: 20px;
}	
.table thead tr th{
	background-color: rgb(235, 235, 235);
}
.table tbody tr td, .table thead tr th {
	padding: 3px 6px;
	font-size: 14px;
}	

.table-striped tbody > tr:nth-child(odd) > td,
.table-striped tbody > tr:nth-child(odd) > th {
    background-color:rgb(201, 201, 201);
	
}

@media print{
	#print {
		display:none;
	}	
	.container{
		padding:0px 0px;
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
			<br>
			<div class="container ">
				<div class="row">
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<div class="text-al">
						<p style="margin:0px">928</p>
						<p style="margin:0px">928.123</p>
						<p style="margin:0px">C038</p>
						<p style="margin:0px">2008</p>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<center>
						<h1>Book Card</h1>
						</center>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<p>2139</p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<center>
						<p style="margin:0px">sample book</p>
						<hr style="margin:0px">
						<p style="font-weight: 700;">Title</p>
						</center>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<center>
						<p style="margin:0px">Maira</p>
						<hr style="margin:0px">
						<p style="font-weight: 700;">Author</p>
						</center>
					</div>
				</div>
				<div>
					<table class="table table-bordered" style="text-align: center;">
						<thead>
							<tr>
								<th style="text-align:center" width="15%">Date</th>
								<th style="text-align:center" width="">Name</th>
								<th style="text-align:center" width="">Course</th>
								<th style="text-align:center" width="15%">Date Due</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>asd</td>
								<td>asd</td>
								<td>asda</td>
								<td>asdas</td>
							</tr>
							<tr>
								<td>asd</td>
								<td>asd</td>
								<td>asda</td>
								<td>asdas</td>
							</tr>
							<tr>
								<td>asd</td>
								<td>asd</td>
								<td>asda</td>
								<td>asdas</td>
							</tr>
							<tr>
								<td>asd</td>
								<td>asd</td>
								<td>asda</td>
								<td>asdas</td>
							</tr>
							<tr>
								<td>asd</td>
								<td>asd</td>
								<td>asda</td>
								<td>asdas</td>
							</tr>
							<tr>
								<td>asd</td>
								<td>asd</td>
								<td>asda</td>
								<td>asdas</td>
							</tr>
							<tr>
								<td>asd</td>
								<td>asd</td>
								<td>asda</td>
								<td>asdas</td>
							</tr>
							<tr>
								<td>asd</td>
								<td>asd</td>
								<td>asda</td>
								<td>asdas</td>
							</tr>

							<tr>
								<td>asd</td>
								<td>asd</td>
								<td>asda</td>
								<td>asdas</td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>


</html>