            <!-- sidebar navigation -->
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="home.php" class="site_title">
                        <img src="../images/logo.jpg" alt="" style="width: 50px;">    
                        <span>LibraSync</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
					<!-- <a href="admin_profile.php"> -->
                    <div class="profile">
                        <?php
                            include('../include/dbcon.php');
                            $user_query=mysqli_query($con,"select *  from user where user_id='$id_session'")or die(mysqli_error());
                            $row=mysqli_fetch_array($user_query); {
                        ?>
                        <div class="profile_pic">
									<!-- <?php if($row['admin_image'] != ""): ?>
									<img src="../upload/<?php echo $row['admin_image']; ?>" style="height:65px; width:75px;" class="img-thumbnail profile_img">
									<?php else: ?> -->
									<img src="../images/user.png" style="height:65px; width:75px;" class="img-circle profile_img">
									<!-- <?php endif; ?>	 -->
                        </div>

                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $row['firstname']; ?></h2>
                        </div>
                    <?php } ?>
                    </div>
					<!-- </a> -->
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3 style="margin-top:85px;">Transaction Information</h3>
							<div class="separator"></div>
                            <ul class="nav side-menu">
                                <li>
									<a href="book.php"><i class="fa fa-book"></i> Books</a>
                                </li>
                                <!-- <li>
									<a href="borrow_book.php?school_number=<?php echo $row['school_number']?>"><i class="fa fa-edit"></i> Borrow</a>
                                </li> -->
                                <li>
									<a href="reserve_book.php?school_number=<?php echo $row['school_number']?>"><i class="fa fa-edit"></i> Reserve</a>
                                </li>
                                <!-- <li>
									<a href="borrowed.php"><i class="fa fa-book"></i> Borrowed Books
                                        <span style="position:absolute;background-color: red; color: white; border-radius: 50%; padding: 3px 7px; font-size: 10px;right:10px">
                                            99
                                        </span>
                                    </a>
                                </li> -->
                                <li>
									<a href="reserved.php"><i class="fa fa-book"></i> Reserved Books
                                        <!-- <span style="position:absolute;background-color: red; color: white; border-radius: 50%; padding: 3px 7px; font-size: 10px;right:10px">
                                            99
                                        </span> -->
                                    </a>
                                </li>
                                <li>
									<a href="returned_book.php"><i class="fa fa-book"></i> Returned Books</a>
                                </li>
                                <!-- <li>
									<a href="settings.php"><i class= "fa fa-cog"></i> Settings</a>
                                </li> -->
                                <!-- <li>
									<a href="report.php"><i class= "fa fa-file"></i> Reports</a>
                                </li>
                                <li>
									<a href="about_us.php"><i class= "fa fa-info"></i> About Us</a>
                                </li> -->
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end of sidebar navigation -->