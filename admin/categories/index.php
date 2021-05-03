<?php
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/header.php');
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/checklogin_admin.php');
?>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="/">Creep's Webshop</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="../users/index">Administrators</a></li>
                    <li class="nav-item"><a class="nav-link" href="../products/index">Products</a></li>
                    <li class="nav-item"><a class="nav-link active" href="../categories/index">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="../customers/index">Customers</a></li>
                </ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="../logout">Log Out</a></span>
            </div>
        </div>
    </nav>

    <div class="container-xl">
	    <div class="table-responsive">
		    <div class="table-wrapper">
			    <div class="table-title">
				    <div class="row">
					    <div class="col-sm-6">
						    <h2>Manage <b>Categories</b></h2>
					    </div>
					    <div class="col-sm-6">
						    <a href="add_category" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New Category</span></a>						
					    </div>
				    </div>
			    </div>
			    <table class="table table-striped table-hover">
				    <thead>
                    <?php
                        $usiqry = $con->prepare("SELECT c.category_id, c.name, c.description, a.active_type FROM category AS c, active as a WHERE c.active = a.active_id");
                        if ($usiqry === false) {
                            trigger_error(mysqli_error($con));
                        } else {
                            $usiqry->bind_result($categoryId, $categoryName, $categoryDescription, $categoryActive);
                            if ($usiqry->execute()) {
                                $usiqry->store_result();
                                echo '<tr>
                                      <th>Category ID</th>
                                      <th>Name</th>
                                      <th>Description</th>
                                      <th>Active</th>
                                      <th>Actions</th>
                                      </tr>';
                                while ($usiqry->fetch() ) { ?>
				    </thead>
				    <tbody>
                    <tr>
                        <td><?php echo $categoryId; ?></td>
                        <td><?php echo $categoryName; ?></td>
                        <td><?php echo $categoryDescription; ?></td>
                        <td><?php echo $categoryActive; ?></td>
                        <td>
							<a href="edit_category?cid=<?php echo $categoryId; ?>" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="delete_category?cid=<?php echo $categoryId; ?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
    include($_SERVER['DOCUMENT_ROOT'] . 'admin/core/footer.php');
?>
