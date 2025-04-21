<?php include ('header.php'); ?>
<script type="text/javascript" charset="utf-8" language="javascript" src="js/html5-qrcode.min.js"></script>
<style>
	#reader {
		width: 300px;
		margin: auto;
	}
</style>
        <!-- <div class="page-title">
            <div class="title_left">
                <h3>
					<small>QR Scanner</small>
                </h3>
            </div>
        </div> -->
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-camera"></i> Reserved QR Scanner</h2>
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
                        <!-- <a  href="./import_students_fmt.xlsx" download="">Click here to download the Excel Format</a> -->
                        <!-- content starts here -->
				<!-- <form class="form-horizontal well" action="import_students_query.php" method="post" name="upload_excel" enctype="multipart/form-data"> -->
                <form class="form-horizontal well"  method="post" name="upload_excel" enctype="multipart/form-data">
					<fieldset>
						<div class="control-group">
                            <!-- <label>Scan Here:</label> -->
                            <!-- <h2>QR Code Scanner</h2> -->
                            <div id="reader"></div>
                            <!-- <p>Scanned Result: <span id="result"></span></p> -->
						</div>
					</fieldset>
				</form>
						
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>
<script>
    function upload_btn() {
        var redirect = "import_students_query.php";
        let doc = document.getElementById("filename").files[0];
        let formData = new FormData();
        formData.append("doc", doc);
        var conf = confirm('Are you sure you want to upload this file?');
        if(conf){
            $.ajax({
                type: "POST",
                url: redirect,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){ 
                    document.getElementById("submit").disabled = true;
                },
                success: function(output){
                    alert('Successfully imported a excel file!');
                    document.location='user.php';
                }
            });
        }
    }

    function onScanSuccess(decodedText, decodedResult) {
		// document.getElementById("result").innerText = decodedText;
		// let IDS = decodedText.split("-"); 
		// var book_id = IDS[0];
		// var borrow_book_id = IDS[1];
		// alert(IDS[0])
		// alert('Successfully Borrowed!');
		window.location="borrow.php?school_number="+decodedText;
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
	startScanner();
</script>
<?php include ('footer.php'); ?>