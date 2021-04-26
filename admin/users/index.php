<?php
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="#">Creep's Webshop</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link active" href="../users/">Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="../products/">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="../customers/">Customers</a></li>
                </ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="../logout.php">Log Out</a></span>
            </div>
        </div>
    </nav>

    <div class="container-xl">
	    <div class="table-responsive">
		    <div class="table-wrapper">
			    <div class="table-title">
				    <div class="row">
					    <div class="col-sm-6">
						    <h2>Manage <b>User</b></h2>
					    </div>
					    <div class="col-sm-6">
						    <a href="add_user.php" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>						
					    </div>
				    </div>
			    </div>
			    <table class="table table-striped table-hover">
				    <thead>
                    <?php
                        $usiqry = $con->prepare("SELECT a.admin_user_id, a.email, a.password_changed, a.datetime FROM admin_user AS a");
                        if ($usiqry === false) {
                            trigger_error(mysqli_error($con));
                        } else {
                            $usiqry->bind_result($adminId, $email, $password_changed, $datetime);
                            if ($usiqry->execute()) {
                                $usiqry->store_result();
                                echo '<tr>
                                      <th>Admin UID</th>
                                      <th>E-Mail</th>
                                      <th>Password Changed</th>
                                      <th>Account Created</th>
                                      <th>Actions</th>
                                      </tr>';
                                while ($usiqry->fetch() ) { ?>
				    </thead>
				    <tbody>
                    <tr>
                        <td><?php echo $adminId; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $password_changed; ?></td>
                        <td><?php echo $datetime; ?></td>
                        <td>
							<a href="edit_user.php?uid=<?php echo $adminId; ?>" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="delete_user.php?uid=<?php echo $adminId; ?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
						</td>
                    </tr>
                    <?php
                                }
                                echo '</table>';
                            }
                        $usiqry->close();
                    } ?>					
				    </tbody>
			    </table>
		    </div>
	    </div>        
    </div>
<?php
    include('../core/footer.php');
?>
