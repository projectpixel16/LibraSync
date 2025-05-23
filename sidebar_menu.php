<style>
    /* body {
      font-family: Arial, sans-serif;
      display: flex;
    } */

    /* .sidebar {
      width: 250px;
      background: #343a40;
      color: white;
      height: 100vh;
      padding-top: 20px;
    } */

    .sidebar a {
      display: block;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
    }

    /* .sidebar a:hover {
      background: #495057;
    } */

    .submenu {
      display: none;
      background: #333;
    }

    .submenu a {
      padding-left: 40px;
    }
  </style>
<!-- sidebar navigation -->
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="home.php" class="site_title">
                        <img src="images/logo.jpg" alt="" style="width: 50px;">    
                        <span>LibraSync</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
					<a href="admin_profile.php">
                    <div class="profile">
<?php
	include('include/dbcon.php');
	$user_query=mysqli_query($con,"select *  from admin where admin_id='$id_session'")or die(mysqli_error());
	$row=mysqli_fetch_array($user_query)
?>
                        <div class="profile_pic">
                            <?php if($row['admin_image'] != ""): ?>
                            <img src="upload/<?php echo $row['admin_image']; ?>" style="height:65px; width:75px;" class="img-thumbnail profile_img">
                            <?php else: ?>
                            <img src="images/user.png" style="height:65px; width:75px;" class="img-circle profile_img">
                            <?php endif; ?>	
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $row['firstname']; ?></h2>
                        </div>
                    </div>
					</a>
                    <!-- /menu prile quick info -->
                    <br />
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
							<h3 style="margin-top:85px;">File Information</h3>
							<div class="separator"></div>
                            <ul class="nav side-menu">
                                <li>
									<a href="home.php"><i class="fa fa-home"></i> Home</a>
                                </li>
                                <li class="nav-item">
                                    <!-- <a class="nav-link dropdown-toggle" href="#userAcctSubmenu" data-toggle="collapse" aria-expanded="false" onclick="event.preventDefault();">
                                        <i class="fa fa-users"></i> 
                                        User Acct Management
                                    </a>
                                    <ul class="collapse nav-item" id="userAcctSubmenu">
                                        <li>
                                            <a class="nav-link" href="admin.php"><i class="fa fa-user"></i> Admin</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="user.php"><i class="fa fa-users"></i> Students</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="user_archive.php"><i class="fa fa-users"></i> Students Archive</a>
                                        </li>
                                    </ul> -->
                                    <div class="sidebar">
                                        <a href="#" class="dropdown-toggle"><i class="fa fa-users"></i> User Acct Management</a>
                                        <div class="submenu">
                                        <a href="admin.php"><i class="fa fa-user"></i>Librarian</a>
                                        <a href="user.php"><i class="fa fa-users"></i>Users</a>
                                        <a href="school.php"><i class="fa fa-home"></i>Schools</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar">
                                        <a href="#" class="dropdown-toggle1"><i class="fa fa-book"></i> Books</a>
                                        <div class="submenu">
                                        <a href="add_book.php"><i class="fa fa-book"></i>Add Book</a>
                                        <a href="book.php"><i class="fa fa-list"></i>Book Listings</a>
                                    </div>
									<!-- <a href="book.php"><i class="fa fa-book"></i> Books</a> -->
                                </li>
                                <li>
                                    <div class="sidebar">
                                        <a href="#" class="dropdown-toggle2"><i class="fa fa-archive"></i> Archives</a>
                                        <div class="submenu">
                                        <a href="user_archive.php"><i class="fa fa-users"></i>Students Archive</a>
                                        <a href="book_archive.php"><i class="fa fa-book"></i>Book Listings Archive</a>
                                        <a href="school_archive.php"><i class="fa fa-home"></i>Schools Archive</a>
                                    </div>
									<!-- <a href="book.php"><i class="fa fa-book"></i> Books</a> -->
                                </li>
                                <!-- <li>
									<a href="book_archive.php"><i class="fa fa-book"></i> Books Archive</a>
                                </li> -->
                                
                            </ul>
                        </div>
                        <div class="menu_section">
                            <h3>Transaction Information</h3>
							<div class="separator"></div>
                            <ul class="nav side-menu">
                                <!-- <li>
									<a href="borrowqr_scanner.php"><i class="fa fa-camera"></i> Borrow QR Scanner</a>
                                </li> -->
                                <li>
									<a href="reserveqr_scanner.php"><i class="fa fa-camera"></i> Reserve QR Scanner</a>
                                </li>
                                <li>
									<a href="borrow.php"><i class="fa fa-edit"></i> Borrowing</a>
                                </li>
                                <!-- <li>
									<a href="borrowed.php"><i class="fa fa-book"></i> Borrowed Books</a>
                                </li> -->
                                <li>
									<a href="returned_book.php"><i class="fa fa-book"></i> Returned Books</a>
                                </li>
                                <li>
									<a href="settings.php"><i class= "fa fa-cog"></i> Settings</a>
                                </li>
                                <li>
									<a href="report.php"><i class= "fa fa-file"></i> Transaction List</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>
            <!-- end of sidebar navigation -->

<script>
  $(document).ready(function () {
    $('.dropdown-toggle').click(function (e) {
      e.preventDefault();
      $(this).next('.submenu').slideToggle(200);
    });
    $('.dropdown-toggle1').click(function (e) {
      e.preventDefault();
      $(this).next('.submenu').slideToggle(200);
    });
    $('.dropdown-toggle2').click(function (e) {
      e.preventDefault();
      $(this).next('.submenu').slideToggle(200);
    });
  });
</script>