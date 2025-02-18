            <!-- top navigation -->
            <div class="top_nav">

            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            include('../include/dbcon.php');
                            $user_query = mysqli_query($con, "SELECT * FROM user WHERE user_id='$id_session'") or die(mysqli_error());
                            $row = mysqli_fetch_array($user_query);
                        ?>
                        
                        
                        
                        
                        <!-- User Profile Dropdown -->
                        <li class="dropdown">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo !empty($row['admin_image']) ? '../upload/'.$row['admin_image'] : '../images/user.png'; ?>">
                                <?php echo $row['firstname']; ?>
                                <span class="fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>

                        <!-- Notification Icon -->
                        <li class="dropdown" >
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="padding-right:25px">
                                <i class="fa fa-bell"></i>
                                <span class="badge badge-danger" style="position:absolute;background:red">3</span> <!-- Dynamic count of notifications -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right animated fadeInDown">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">See all notifications</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>


            </div>
            <!-- /top navigation -->