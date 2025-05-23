<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Home / Students /</small>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="background: #2c93fd7d;">
                    <div class="x_title">
                        <h2><i class="fa fa-upload"></i> Import From Excel Files</h2>
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
                        <a  href="./import_students_fmt.xlsx" download="">Click here to download the Excel Format</a>
                        <!-- content starts here -->
				<!-- <form class="form-horizontal well" action="import_students_query.php" method="post" name="upload_excel" enctype="multipart/form-data"> -->
                <form class="form-horizontal well"  method="post" name="upload_excel" enctype="multipart/form-data">
					<fieldset>
						<div class="control-group">
							
								<label>Excel File:</label>
							
							<div class="controls">
								<input type="file" multiple name="filename" id="filename" class="input-large">
							</div>
						</div>
						<br/>	
						<div class="control-group">
							<div class="controls">
							<button type="button" id="submit" name="submit" onclick="upload_btn()" class="btn btn-success button-loading" data-loading-text="Loading..."><i class="fa fa-upload"></i> Upload</button>
							<a href="user.php"><button type="button" class="btn btn-danger button-loading"><i class="fa fa-reply"></i> Back</button></a>
							</div>
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
</script>
<?php include ('footer.php'); ?>