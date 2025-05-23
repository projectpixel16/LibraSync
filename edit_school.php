<?php include ('include/dbcon.php');
$ID=$_GET['school_id'];
 ?>
<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Home / School /</small> Edit School
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="background: #2c93fd7d;">
                    <div class="x_title">
                        <h2><i class="fa fa-pencil"></i> Edit School</h2>
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
<?php
  $query=mysqli_query($con,"select * from schools where school_id='$ID'")or die(mysqli_error());
$row=mysqli_fetch_array($query);
  ?>

                            <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" onsubmit="return confirmUpdate('school');">
                        <!---        <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">User Image <span class="required">*</span>
                                    </label>
                                    <div class="col-md-4">
										<a href=""><?php // if($row['user_image'] != ""): ?>
										<img src="upload/<?php // echo $row['user_image']; ?>" width="100px" height="100px" style="border:4px groove #CCCCCC; border-radius:5px;">
										<?php // else: ?>
										<img src="images/user.png" width="100px" height="100px" style="border:4px groove #CCCCCC; border-radius:5px;">
										<?php // endif; ?>
										</a>
                                        <input type="file" style="height:44px; margin-top:10px;" name="image" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>	-->
                                <div class="form-group">
									<label class="control-label col-md-4" for="last-name">School Type
									</label>
									<div class="col-md-4">
                                        <select name="type" id="type" class=" form-control" required="required" tabindex="-1">
                                            <option value="">--Select Type--</option>
                                            <option value="Public" <?php echo ($row['school_type']=='Public') ? 'selected' : ''?>>Public</option>
                                            <option value="Private"<?php echo ($row['school_type']=='Private') ? 'selected' : ''?>>Private</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">School Name
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" value="<?php echo $row['school_name']; ?>" name="school_name" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Address
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" value="<?php echo $row['address']; ?>" name="address" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Contact / Telephone No.
                                    </label>
                                    <div class="col-md-4">
                                        <input type='text' value="<?php echo $row['contact_no']; ?>" autocomplete="off" name="contact" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="email">Email Address
                                    </label>
                                    <div class="col-md-4">
                                        <input type='email' value="<?php echo $row['email_address']; ?>" autocomplete="off" name="email" id="email" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>						
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
                                        <a href="school.php"><button type="button" class="btn btn-primary"><i class="fa fa-times-circle-o"></i> Cancel</button></a>
                                        <button type="submit" name="update" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                                    </div>
                                </div>
                            </form>
							
<?php
    $id =$_GET['school_id'];
    if (isset($_POST['update'])) {
        $school_name = $_POST['school_name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $type = $_POST['type'];
        mysqli_query($con," UPDATE schools SET school_name='$school_name', contact_no='$contact', address='$address', email_address='$email', school_type='$type' WHERE school_id = '$id' ")or die(mysqli_error());
        echo "<script>alert('Successfully Updated School Info!'); window.location='school.php'</script>";
    }
?>
						
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>
<?php include ('footer.php'); ?>