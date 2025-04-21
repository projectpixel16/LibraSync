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
					<small>Home / Student</small>
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
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

                            <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                <div class="form-group">
									<label class="control-label col-md-4" for="last-name">Type <span class="required" style="color:red;">*</span>
									</label>
									<div class="col-md-3">
                                        <select name="type" id="type" class=" form-control" required="required" tabindex="-1" onChange='generateUniqueId()'>
                                            <option value="Student">Student</option>
                                            <option value="Community Member">Community Member</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">ID Number <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-3">
                                        <input type="number" name="school_number" id="school_number" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="school_name">School Name
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" name="school_name" id="school_name"  class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="password">Password <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="password" name="password" placeholder="Password" id="password" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                        <div class="col-md-2" style="right: 19px!important;">
                                            <button type="button" class="toggle-password btn btn-sm btn-success" onclick="togglePassword()"><span><i class="fa fa-eye"></i></span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">First Name <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="firstname" placeholder="First Name....." id="first-name2" required="required" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Middle Name
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="middlename" placeholder="MI / Middle Name....." id="first-name2" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Last Name <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="lastname" placeholder="Last Name....." id="last-name2" required="required" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Email Address
                                    </label>
                                    <div class="col-md-4">
                                        <input type="email" name="email" placeholder="Email Address" id="email" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Contact <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="tel" pattern="[0-9]{11,11}" autocomplete="off"  maxlength="11" name="contact" id="last-name2" class="form-control " required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Gender <span class="required" style="color:red;">*</span>
                                    </label>
									<div class="col-md-4">
                                        <select name="gender" class="form-control" required="required" tabindex="-1" >
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>								
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Address <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="address" id="last-name2" class="form-control " required>
                                    </div>
                                </div>
                                <!-- <div class="ln_solid"></div> -->
                                <hr>
                                <div class="form-group">
                                    <center>
                                        <div class="">
                                            <a href="user.php">
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
									$school_number = $_POST['school_number'];
									$school_name = $_POST['school_name'];
									$password = $_POST['password'];
									$firstname = $_POST['firstname'];
									$middlename = $_POST['middlename'];
									$lastname = $_POST['lastname'];
									$email = $_POST['email'];
									$contact = $_POST['contact'];
									$gender = $_POST['gender'];
									$address = $_POST['address'];
									$type = $_POST['type'];
									// $level = $_POST['level'];
									// $section = $_POST['section'];
					
					$result=mysqli_query($con,"select * from user WHERE school_number='$school_number' ") or die (mysqli_error());
					$row=mysqli_num_rows($result);
					if ($row > 0)
					{
					echo "<script>alert('Student ID already exists!'); window.location='user.php'</script>";
					}
					else
					{		
						mysqli_query($con,"insert into user (school_number,school_name,firstname, middlename, lastname, contact, gender, address, type, status, password, email, user_added)
						values ('$school_number','$school_name','$firstname', '$middlename', '$lastname', '$contact', '$gender', '$address', '$type', 'Active', '$password', '$email', NOW())")or die(mysqli_error());
						echo "<script>alert('User successfully added!'); window.location='user.php'</script>";
					}
			//						}
			//						}
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

    function generateUniqueId(){
        var type = document.getElementById("type").value; 
        var redirect = "get_idnumber.php";
        $.ajax({
            data: "type="+type,
            type: "POST",
            url: redirect,
            success: function(output){
                document.getElementById('school_number').value=output;
                if(output!=''){
                    document.getElementById('school_number').readOnly=true;
                }else{
                    document.getElementById('school_number').readOnly=false;
                }
            }
        });
    }
</script>
<?php include ('footer.php'); ?>