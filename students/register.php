<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RMSMLL -   LibraSync</title>

    <!-- Bootstrap core CSS -->

    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="../css/custom.css" rel="stylesheet">
    <link href="../css/icheck/flat/green.css" rel="stylesheet">


    <script src="../js/jquery.min.js"></script>

<style>
.blink_text {
-webkit-animation-name: blinker;
-webkit-animation-duration: 1s;
-webkit-animation-timing-function: linear;
-webkit-animation-iteration-count: infinite;

-moz-animation-name: blinker;
-moz-animation-duration: 1s;
-moz-animation-timing-function: linear;
-moz-animation-iteration-count: infinite;

 animation-name: blinker;
 animation-duration: 1s;
 animation-timing-function: linear;
 animation-iteration-count: infinite;

 color:white;
 font-size:16px;
}

@-moz-keyframes blinker {  
 0% { opacity: 1.0; }
 50% { opacity: 0.0; }
 100% { opacity: 1.0; }
 }

@-webkit-keyframes blinker {  
 0% { opacity: 1.0; }
 50% { opacity: 0.0; }
 100% { opacity: 1.0; }
 }

@keyframes blinker {  
 0% { opacity: 1.0; }
 50% { opacity: 0.0; }
 100% { opacity: 1.0; }
 }
</style>
</head>

<body style="background:#F7F7F7;">
    
    <div class="">

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content" style="text-align: left;">
                <form method="post" enctype="multipart/form-data" class="">
                    <h1 style="text-align: center;">Registration Form</h1>
                    
                    <div class="form-group">
                        <label class="control-label " for="first-name">ID Number <span class="required" style="color:red;">*</span>
                        </label>
                        <div class="">
                            <input type="number" name="school_number" id="first-name2" required="required" class="form-control  col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="password">Password <span class="required" style="color:red;">*</span>
                        </label>
                        <div class="">
                            <input type="password" name="password" placeholder="Password" id="password" required="required" class="form-control  col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="first-name">First Name <span class="required" style="color:red;">*</span>
                        </label>
                        <div class="">
                            <input type="text" name="firstname" placeholder="First Name....." id="first-name2" required="required" class="form-control  col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="first-name">Middle Name
                        </label>
                        <div class="">
                            <input type="text" name="middlename" placeholder="MI / Middle Name....." id="first-name2" class="form-control  col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="last-name">Last Name <span class="required" style="color:red;">*</span>
                        </label>
                        <div class="">
                            <input type="text" name="lastname" placeholder="Last Name....." id="last-name2" required="required" class="form-control  col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="last-name">Email Address
                        </label>
                        <div class="">
                            <input type="email" name="email" placeholder="Email Address" id="email" class="form-control  col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="last-name">Contact <span class="required" style="color:red;">*</span>
                        </label>
                        <div class="">
                            <input type="tel" pattern="[0-9]{11,11}" autocomplete="off"  maxlength="11" name="contact" id="last-name2" class="form-control  col-xs-12" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="last-name">Gender <span class="required" style="color:red;">*</span>
                        </label>
                        <div class="">
                            <select name="gender" class="select2_single form-control" required="required" tabindex="-1" >
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>								
                    <div class="form-group">
                        <label class="control-label " for="last-name">Address <span class="required" style="color:red;">*</span>
                        </label>
                        <div class="">
                            <input type="text" name="address" id="last-name2" class="form-control  col-xs-12" required>
                        </div>
                    </div>
                    
                    <div class="ln_solid"></div>
                    <div class=" ">
                        <button type="submit" name="submit" class="btn btn-success btn-block"><i class="fa fa-plus-square"></i> Submit</button>
                    </div>
                    <br>
                    <div class="text-center text-sm">
                        <span>Already have an account?  <a href="index.php" style="color:blue">Login here.</a></span>
                    </div>
                    <hr  style="margin-top: 0px;">
                </form>
                <div class="clearfix"></div>
                <div class="separator" style="text-align:center">
                
                    <div class="clearfix"></div>
                    <br />
                    <div>
                        <h2><i class="fa fa-university" style="font-size: 26px;"></i> Rafael M. Salas Memorial Library</h2>

                        <p>© <?php echo date('Y'); ?> <i class="fa fa-book"></i>   LibraSync</p>
                    </div>
                </div>
<?php
include('../include/dbcon.php');

if (isset($_POST['login'])){

$username=$_POST['username'];
$password=$_POST['password'];

$login_query=mysqli_query($con,"select * from   user where school_number='$username' and password='$password'");
$count=mysqli_num_rows($login_query);
$row=mysqli_fetch_array($login_query);

if ($count > 0){
session_start();
$_SESSION['id']=$row['user_id'];

echo "<script>window.location='home.php'</script>";
}else{ ?>
<div class="alert alert-danger"><h3 class="blink_text">Access Denied</h3></div>		
<?php
}
}
?>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>

</body>

</html>