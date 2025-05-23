<?php include ('include/dbcon.php');
$ID=$_GET['user_id'];
 ?>
<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Home / Users /</small> Edit User
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="background: #2c93fd7d;">
                    <div class="x_title">
                        <h2><i class="fa fa-pencil"></i> Edit User</h2>
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
  $query=mysqli_query($con,"select * from user where user_id='$ID'")or die(mysqli_error());
$row=mysqli_fetch_array($query);
  ?>

                            <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" onsubmit="return confirmUpdate('user');">
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
                                    <label class="control-label col-md-4" for="first-name">ID Number
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" readOnly value="<?php echo $row['school_number']; ?>" name="school_number" id="first-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="password">Password
									</label>
                                    <div class="col-md-4">
                                        <input type="password" value="" name="password" id="password" class="form-control col-md-7 col-xs-12">
                                    </div>
                                    <div class="col-md-2" style="right: 19px!important;">
                                        <button type="button" class="toggle-password btn btn-sm btn-success" onclick="togglePassword()"><span><i class="fa fa-eye"></i></span></button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="password"></label>
                                    <div class="col-md-5">
                                        <span>Leave empty if you do not want to change the password.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">First Name
									</label>
                                    <div class="col-md-4">
                                        <input type="text" value="<?php echo $row['firstname']; ?>" name="firstname" id="first-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Middle Name
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="middlename" value="<?php echo $row['middlename']; ?>" placeholder="MI / Middle Name....." id="first-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Last Name
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" value="<?php echo $row['lastname']; ?>" name="lastname" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="email">Email Address
                                    </label>
                                    <div class="col-md-4">
                                        <input type='email' value="<?php echo $row['email']; ?>" autocomplete="off" name="email" id="email" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Contact
                                    </label>
                                    <div class="col-md-4">
                                        <input type='tel' value="<?php echo $row['contact']; ?>" autocomplete="off"  maxlength="11" name="contact" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Gender
                                    </label>
									<div class="col-md-4">
                                        <select name="gender" class="select2_single form-control" tabindex="-1" >
                                            <option value="Male" <?php echo ($row['gender']=='Male') ? 'selected' : ''?>>Male</option>
                                            <option value="Female" <?php echo ($row['gender']=='Female') ? 'selected' : ''?>>Female</option>
                                        </select>
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
                                    <label class="control-label col-md-4" for="last-name">ID Image
                                    </label>
                                    <div class="col-md-4">
										<?php if($row['id_image'] != ""): ?>
										<img src="upload/<?php echo $row['id_image']; ?>" width="100px" height="100px" style="border:4px groove #CCCCCC; border-radius:5px;">
										<?php else: ?>
										<img src="images/user.png" width="100px" height="100px" style="border:4px groove #CCCCCC; border-radius:5px;">
										<?php endif; ?>
                                        <input type="file" style="height:44px; margin-top:10px;" name="image" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
                                        <a href="user.php"><button type="button" class="btn btn-primary"><i class="fa fa-times-circle-o"></i> Cancel</button></a>
                                        <button type="submit" name="update" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                                    </div>
                                </div>
                            </form>
							
<?php
$id =$_GET['user_id'];
if (isset($_POST['update'])) {
    $school_number = $_POST['school_number'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $image = $_FILES["image"] ["name"];
    $image_name= addslashes($_FILES['image']['name']);
    $size = $_FILES["image"] ["size"];
    $error = $_FILES["image"] ["error"];
    if($size > 10000000){
        die("Format is not allowed or file size is too big!");
    }else{
        move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" . $_FILES["image"]["name"]);			
        $id_image=$_FILES["image"]["name"];
        if($password!=''){
            mysqli_query($con," UPDATE user SET school_number='$school_number', firstname='$firstname', middlename='$middlename', lastname='$lastname', contact='$contact', gender='$gender', address='$address', email='$email', password='$password', id_image='$id_image' WHERE user_id = '$id' ")or die(mysqli_error());
        }else{
            mysqli_query($con," UPDATE user SET school_number='$school_number', firstname='$firstname', middlename='$middlename', lastname='$lastname', contact='$contact', gender='$gender', address='$address', email='$email', id_image='$id_image' WHERE user_id = '$id' ")or die(mysqli_error());
        }
        echo "<script>alert('Successfully Updated User Info!'); window.location='user.php'</script>";
    }
}
?>
						
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>
<script>
    function togglePassword(){
        var passwordInput = document.getElementById('password');
        if(passwordInput.type === "password"){
            passwordInput.type="text";
        }else{
            passwordInput.type="password";
        }
    }
</script>
<?php include ('footer.php'); ?>