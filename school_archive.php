<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					<small>Home /</small> Schools Archive
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-users"></i> Schools Archive Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <!-- <li>
							<a href="add_school.php" style="background:none;">
							<button class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Add School</button>
							</a>
							</li> -->
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

						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								
							<thead>
								<tr>
							<!---		<th>Image</th>	-->
									<th>School Name</th>
									<th>School Type</th>
									<th>Address</th>
									<th>Contact No.</th>
									<th>Email Address</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							
							<?php
							$result= mysqli_query($con,"select * from schools where status='Inactive' order by school_name ASC") or die (mysqli_error());
							while ($row= mysqli_fetch_array ($result) ){
							?>
							<tr>
								<td><?php echo $row['school_name']?></td> 
								<td><?php echo $row['school_type']?></td> 
								<td><?php echo $row['address'] ?></td> 
								<td><?php echo $row['contact_no']; ?></td> 
								<td><?php echo $row['email_address']; ?></td> 
								<td>
									<a title="Archive" class="btn btn-success" for="DeleteAdmin" href="#delete<?php echo $row['school_id'];?>" data-toggle="modal" data-target="#delete<?php echo $row['school_id'];?>">
										<i class="glyphicon glyphicon-upload icon-white"></i>
									</a>
			
									<!-- delete modal user -->
									<div class="modal fade" id="delete<?php  echo $row['school_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-home"></i> School Archive</h4>
										</div>
										<div class="modal-body">
												<div class="alert alert-danger">
													Are you sure you want to unarchive this school?
												</div>
												<div class="modal-footer">
												<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> No</button>
												<a href="delete_school1.php<?php echo '?school_id='.$row['school_id']; ?>" style="margin-bottom:5px;" class="btn btn-primary"><i class="glyphicon glyphicon-ok icon-white"></i> Yes</a>
												</div>
										</div>
										</div>
									</div>
									</div>
								</td> 
							</tr>
							<?php } ?>
							</tbody>
							</table>
						</div>
						
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>