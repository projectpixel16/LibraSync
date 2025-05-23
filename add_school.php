<?php 
    include ('header.php'); 
?>
<style>
    .password-container {
        position: relative;
        display:inline-block;
    }
    .toggle-password {
        transform: translateY(4.5%);
        cursor:pointer;
        font-size:12px;
    }
</style>
        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Home / Add School</small>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="background: #2c93fd7d;">
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

                            <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" onsubmit="return confirmSave('school');">
                                <div class="form-group">
									<label class="control-label col-md-4" for="last-name">School Type <span class="required" style="color:red;">*</span>
									</label>
									<div class="col-md-4">
                                        <select name="type" id="type" class=" form-control" required="required" tabindex="-1">
                                            <option value="">--Select Type--</option>
                                            <option value="Public">Public</option>
                                            <option value="Private">Private</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="school_name" id="changelabel">School Name <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="school_name" id="school_name" required class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="address">Address <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="address" id="address2" class="form-control " required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Contact / Telephone No. <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" autocomplete="off"  maxlength="11" name="contact" id="last-name2" class="form-control " required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Email Address
                                    </label>
                                    <div class="col-md-4">
                                        <input type="email" name="email" placeholder="Email Address" id="email" class="form-control ">
                                    </div>
                                </div>			
                                <hr>
                                <div class="form-group">
                                    <center>
                                        <div class="">
                                            <a href="school.php">
                                                <button type="button" class="btn btn-primary" style="font-size:14px;padding:5px 10px"><i class="fa fa-times-circle-o"></i> Cancel</button>
                                            </a>
                                            <button type="submit" name="submit" class="btn btn-success" style="font-size:14px;padding:5px 10px"><i class="fa fa-plus-square"></i> Submit</button>
                                        </div>
                                    </center>
                                </div>
                            </form>
							
							<?php	
							    include ('include/dbcon.php');
                                if (isset($_POST['submit'])){
                                    $type = $_POST['type'];
									$school_name = $_POST['school_name'];
									$email = $_POST['email'];
									$contact = $_POST['contact'];
									$address = $_POST['address'];
					
                                    $result=mysqli_query($con,"select * from schools WHERE school_name='$school_name' ") or die (mysqli_error());
                                    $row=mysqli_num_rows($result);
                                    if ($row > 0)
                                    {
                                        echo "<script>alert('School already exists!'); window.location='school.php'</script>";
                                    }
                                    else
                                    {		
                                        mysqli_query($con,"insert into schools (school_name, contact_no, address, school_type, status, email_address)
                                        values ('$school_name', '$contact', '$address', '$type', 'Active','$email')")or die(mysqli_error());
                                        echo "<script>alert('School successfully added!'); window.location='school.php'</script>";
                                    }
							    }
							?>
						
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>
<?php include ('footer.php'); ?>